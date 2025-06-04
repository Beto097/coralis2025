<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\archivo;
use App\Models\paciente;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Session;

class archivoController extends Controller
{
    public function insert(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        
        if(Auth::user()->accesoRuta('/archivo/insertar')){

            
            $request->validate([
                'archivo' => 'required|file|mimes:pdf,doc,docx,txt,jpg,png|max:102400', // 100 MB en KB - BHETO
            ]);
    
            // Obtener el archivo
            $file = $request->file('archivo');
    
            // Obtener fecha actual para crear carpeta por año/mes
            $fecha = Carbon::now();
            $rutaCarpeta = 'archivos/' . $fecha->format('Y') . '/' . $fecha->format('m');
            
            // Obtener extensión del archivo
            $extension = $file->getClientOriginalExtension();
    
            // Crear nombre del archivo a guardar (ej: Crear_Usuario.pdf)
            $nombreArchivo = Str::slug($request->txtNombre). $fecha->format('Y-m-d') . '.' . $extension;
    
            // Guardar el archivo con nombre personalizado
            $file->move(public_path($rutaCarpeta), $nombreArchivo);
            
            // Guardar datos en base de datos
            $archivo = new Archivo();
            $archivo->paciente_id = $request->txtId;
            $archivo->nombre = $request->txtNombre;
            $archivo->ruta = $rutaCarpeta . '/' . $nombreArchivo; // guarda la ruta relativa (útil para mostrar)        
            $archivo->save();
    
            return redirect()->back()->withErrors(['status' => "Se subio el archivo correctamente" ]);
        }
        
              
        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta funcion." ]);            

        
    }

    public function verArchivos($id){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        
        if(Auth::user()->accesoRuta('/archivo/ver')){

            
            $paciente = paciente::find($id);         
    
            return view ("archivo.index",["paciente"=>$paciente]);
        }
        
              
        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta funcion." ]);            

        
    }

    public function delete($id){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        
        if(Auth::user()->accesoRuta('/archivo/delete')){

            $archivo = Archivo::find($id);

            // Ruta absoluta del archivo físico
            $rutaArchivo = public_path($archivo->ruta);

            // Verificar y eliminar el archivo
            if (File::exists($rutaArchivo)) {
                File::delete($rutaArchivo);
            }

            // Eliminar el registro de la base de datos
            $archivo->delete();

            return redirect()->back()->withErrors(['status' => "Se elimino el archivo correctamente" ]);
        }
        
              
        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta funcion." ]);            

    
    }
}
