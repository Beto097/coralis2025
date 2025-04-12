<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


            for ($i = 0; $i < count($request->txtCantidad); $i++) {

                $receta = new receta();
                $receta->cantidad = $request->txtCantidad[$i];
                $receta->medicamento = $request->txtMedicamento[$i];
                $receta->dosis = $request->txtDosis[$i];
                $receta->tratamiento = $request->txtTratamiento[$i];
                $receta->consulta_id = $request->txtIdConsulta;
                $receta->numero = receta::ultimaReceta();

                $receta->save();
    
            }
            if ($request->accion == 'guardar') {

                return redirect()->back()->withErrors(['status' => "Se ha creado correctamente la receta"]);
            
            }

            if(Auth::user()->accesoRuta('/receta/imprimir')){

                $consulta = consulta::find($request->txtIdConsulta);
                
    
                $pdf= \PDF::loadView('consulta.pdf',['consulta'=>$consulta])->setPaper([0, 0, 419.5276, 595.2756]);
                $nombreArchivo = $consulta->paciente->identificacion_paciente.'.pdf';
                return $pdf->download($nombreArchivo);                
               
                
            }

            
            
        }

        return redirect(route('index'));
        


    }

    public function edit(Request $request){
  
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }


        if(Auth::user()->accesoRuta('/receta/create')){

            if ($request->has('txtEliminarId') && $request->txtEliminarId != null) {
                
                $idsEliminar = json_decode($request->txtEliminarId, true);
                receta::whereIn('id',$idsEliminar)->delete();

            }

            for ($i = 0; $i < count($request->txtCantidad); $i++) {

                if($request->txtFilaId[$i] != null){

                    $receta =  receta::find($request->txtFilaId[$i]);
                    

                }else{
                    
                    $receta = new receta();

                }

                $receta->cantidad = $request->txtCantidad[$i];
                $receta->medicamento = $request->txtMedicamento[$i];
                $receta->dosis = $request->txtDosis[$i];
                $receta->tratamiento = $request->txtTratamiento[$i];
                $receta->consulta_id = $request->txtIdConsulta;
                $receta->save();    

    
            }

            if ($request->accion == 'guardar') {

                return redirect()->back()->withErrors(['status' => "Se ha editado correctamente la receta"]);
            
            }

            if(Auth::user()->accesoRuta('/receta/imprimir')){

                $consulta = consulta::find($request->txtIdConsulta);
                
    
                $pdf= \PDF::loadView('consulta.pdf',['consulta'=>$consulta])->setPaper([0, 0, 419.5276, 595.2756]);
                $nombreArchivo = $consulta->paciente->identificacion_paciente.'.pdf';
                return $pdf->download($nombreArchivo);                
               
                return redirect()->back()->withErrors(['status' => "Se ha editado correctamente la receta"]);
            }
    
            
           
            
        }
    

        
        return redirect(route('index'));

        


    }

    public function print($id){
        
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/receta/imprimir')){

            $consulta = consulta::find($id);
            

            $pdf= \PDF::loadView('consulta.pdf',['consulta'=>$consulta])->setPaper([0, 0, 419.5276, 595.2756]);
            $nombreArchivo = $consulta->paciente->identificacion_paciente.'.pdf';
            return $pdf->stream($nombreArchivo);
            
            return redirect()->back()->withErrors(['status' => "Se imprimio correctamente la receta"]);
            
            
        }

        return redirect(route('index'));

        


    }


}
