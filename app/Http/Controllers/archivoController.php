<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\archivo;

use Carbon\Carbon;
use Session;

class archivoController extends Controller
{
    public function insert(Request $request)
    {
        if (!Auth::user()) {
            Session::put('url', url()->current());
            return redirect(route('login.index'));
        }

        if (Auth::user()->accesoRuta('/archivo/insertar')) {

            $request->validate([
                'archivo' => 'required|file|mimes:pdf,doc,docx,txt,jpg,png|max:2048',
            ]);

            // Obtener el archivo
            $file = $request->file('archivo');

            // Obtener fecha actual para crear carpeta por año/mes
            $fecha = Carbon::now();
            $rutaCarpeta = 'archivos/' . $fecha->format('Y') . '/' . $fecha->format('m');

            // Obtener extensión del archivo
            $extension = $file->getClientOriginalExtension();

            // Crear nombre del archivo a guardar (ej: Crear_Usuario.pdf)
            $nombreArchivo = Str::slug($request->txtNombre) . '.' . $extension;

            // Guardar el archivo en el disco 'public'
            $rutaCompleta = $file->storeAs($rutaCarpeta, $nombreArchivo, 'public');

            // Guardar ruta web con prefijo /storage/
            $rutaWeb = '/storage/' . $rutaCompleta;

            // Guardar datos en base de datos
            $archivo = new Archivo();
            $archivo->consulta_id = $request->txtId;
            $archivo->nombre = $request->txtNombre;
            $archivo->ruta = $rutaWeb;
            $archivo->save();

            return redirect()->back()->withErrors(['status' => "Se subió el archivo correctamente"]);
        }

        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta función."]);
    }

    public function delete($id)
    {
        if (!Auth::user()) {
            Session::put('url', url()->current());
            return redirect(route('login.index'));
        }

        if (Auth::user()->accesoRuta('/archivo/delete')) {

            // Buscar el archivo en la base de datos
            $archivo = Archivo::find($id);

            // Eliminar el archivo físico del disco
            $rutaSinStorage = str_replace('/storage/', '', $archivo->ruta);

            if (Storage::disk('public')->exists($rutaSinStorage)) {
                Storage::disk('public')->delete($rutaSinStorage);
            }

            // Eliminar el registro de la base de datos
            $archivo->delete();

            return redirect()->back()->withErrors(['status' => "Se eliminó el archivo correctamente"]);
        }

        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta función."]);
    }
}
