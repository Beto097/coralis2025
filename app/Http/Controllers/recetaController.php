<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\receta;
use App\Models\consulta;


use Session;

class recetaController extends Controller
{

    public function recetaSave(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/receta/create')){

            $numeroBase = receta::ultimaReceta();
            // Agrupar datos por tipo de dosis
            $data = [];
            for ($i = 0; $i < count($request->txtCantidad); $i++) {
                $tipo= $request->txtTipo[$i];
                $data[$tipo][] = [
                    'cantidad' => $request->txtCantidad[$i],
                    'medicamento' => $request->txtMedicamento[$i],
                    'tipo' =>$tipo,
                    'dosis' => $request->txtDosis[$i],
                    'tratamiento' => $request->txtTratamiento[$i],
                ];
            }
            $contadorGlobal = $numeroBase;
            // Procesar cada grupo de dosis
            foreach ($data as $grupoTipo) {
                $grupoCount = count($grupoTipo);
                for ($i = 0; $i < $grupoCount; $i++) {
                    // Cada 2 elementos se incrementa el número
                    $numeroAsignado = $contadorGlobal + intdiv($i, 2);

                    $receta = new receta();
                    $receta->cantidad = $grupoTipo[$i]['cantidad'];
                    $receta->medicamento = $grupoTipo[$i]['medicamento'];
                    $receta->tipo = $grupoTipo[$i]['tipo'];
                    $receta->dosis = $grupoTipo[$i]['dosis'];
                    $receta->tratamiento = $grupoTipo[$i]['tratamiento'];
                    $receta->consulta_id = $request->txtIdConsulta;
                    $receta->numero = $numeroAsignado;
                    $receta->save();
                }

                // Incrementar el contador global al final de cada grupo
                $contadorGlobal += intdiv($grupoCount + 1, 2); // Redondea hacia arriba cada 2
            }
   
   
           

            return redirect()->back()->withErrors(['status' => "Se ha creado correctamente la receta"]);
            
            

            
            
        }

        return redirect(route('index'));
        


    }

    public function edit(Request $request){
  
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }


        if(Auth::user()->accesoRuta('/receta/create')){
            
                
                
            receta::where('consulta_id',$request->txtIdConsulta)->delete();

            $numeroBase = receta::ultimaReceta();
            // Agrupar datos por tipo de dosis
            $data = [];
            for ($i = 0; $i < count($request->txtCantidad); $i++) {
                $tipo= $request->txtTipo[$i];
                $data[$tipo][] = [
                    'cantidad' => $request->txtCantidad[$i],
                    'medicamento' => $request->txtMedicamento[$i],
                    'tipo' =>$tipo,
                    'dosis' => $request->txtDosis[$i],
                    'tratamiento' => $request->txtTratamiento[$i],
                ];
            }
            $contadorGlobal = $numeroBase;
            // Procesar cada grupo de dosis
            foreach ($data as $grupoTipo) {
                $grupoCount = count($grupoTipo);
                for ($i = 0; $i < $grupoCount; $i++) {
                    // Cada 2 elementos se incrementa el número
                    $numeroAsignado = $contadorGlobal + intdiv($i, 2);

                    $receta = new receta();
                    $receta->cantidad = $grupoTipo[$i]['cantidad'];
                    $receta->medicamento = $grupoTipo[$i]['medicamento'];
                    $receta->dosis = $grupoTipo[$i]['dosis'];
                    $receta->tratamiento = $grupoTipo[$i]['tratamiento'];
                    $receta->consulta_id = $request->txtIdConsulta;
                    $receta->numero = $numeroAsignado;
                    $receta->save();
                }

                // Incrementar el contador global al final de cada grupo
                $contadorGlobal += intdiv($grupoCount + 1, 2); // Redondea hacia arriba cada 2
            }
   
           

            return redirect()->back()->withErrors(['status' => "Se ha creado correctamente la receta"]);

            
           
            
        }
    

        
        return redirect(route('index'));

        


    }

    public function print($id){
        
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/receta/imprimir')){

            $consulta = consulta::with('recetas')->find($id);
            
            $grupos = $consulta->recetas->groupBy('numero');
            $firmaPath = public_path("img/firmas/{$consulta->doctor->nombre_usuario}.PNG");
            $selloPath = public_path("img/sellos/{$consulta->doctor->nombre_usuario}.PNG");

            
            $firmaExiste = File::exists($firmaPath);
            $selloExiste = File::exists($selloPath);

            $pdf = \PDF::loadView('consulta.pdf', [
                'consulta' => $consulta,
                'grupos' => $grupos,
                'firma' => $firmaExiste,
                'sello' => $selloExiste
            ])->setPaper([0, 0, 419.5276, 595.2756]);

            $nombreArchivo = $consulta->paciente->identificacion_paciente.'.pdf';
            return $pdf->stream($nombreArchivo);
            
            return redirect()->back()->withErrors(['status' => "Se imprimio correctamente la receta"]);
            
            
        }

        return redirect(route('index'));

        


    }


}
