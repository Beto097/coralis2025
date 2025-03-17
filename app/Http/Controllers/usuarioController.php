<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\rol;
use App\Models\sucursal;

use Session;

class usuarioController extends Controller
{
    public function index(){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/usuario')){
                        
            if (Auth::user()->rol->tipo_rol == 1) {
                $resultado = User::get();  
            } else {
                $resultado = User::where('estado_usuario',1)->get(); 
            }            

            return view ("usuario.index", ["resultado"=>$resultado]);
            
        }

        return redirect(route('index'));
    }

    public function create(){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/usuario/create')){

            $roles = rol::where('estado_rol',1)->get();
            $sucursales = sucursal::where('estado_sucursal',1)->get();

            return view ("usuario.create", ['roles'=>$roles,'sucursales'=>$sucursales]);

        }

        return redirect(route('index'));


    }

    public function insert(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/usuario/create')){
            
            $contraseña_verificada = md5($request->txtPassword); 
            $nombre_existe = User::where('nombre_usuario', $request->txtUsuario)->count();

            if($nombre_existe>0){

                return redirect()->back()->withInput()->withErrors(['danger' => 'Este usuario ya existe' ]);

            }

           
            $obj_usuario = new User();
            $obj_usuario->nombre_usuario = $request->txtUsuario;
            $obj_usuario->email_usuario = $request->txtEmail;
            $obj_usuario->password_usuario = $contraseña_verificada;
            $obj_usuario->rol_id = $request->selectRol;
            $obj_usuario->sucursal_id = $request->selectSucursal;
            $obj_usuario->estado_usuario = $request->txtEstado;

            try {
                
                $obj_usuario->save();
                return redirect(route('usuario.index'))->withErrors(['status' => "Se ha creado el usuario: : ".$obj_usuario->nombre_usuario ]);

            } catch (\Illuminate\Database\QueryException $qe) {                
                return redirect()->back()->withErrors(['danger' => 'error al crear el usuario.' ]);
            } catch (Exception $e) {
                return redirect()->back()->withErrors(['danger' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['danger' => $th]);
            }  


            return redirect(route('usuario.index'))->withErrors(['status' => "Se ha creado el usuario: ".$obj_usuario->nombre_usuario ]);

        }

        return redirect(route('index'));


    }


    public function save(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        

        if(Auth::user()->accesoRuta('/usuario/update')){
           
            $obj_usuario = User::find($request->txtId);
            if($request->txtPassword==($obj_usuario->password_usuario)){
                $contraseña_verificada = $obj_usuario->password_usuario;
                
            }else{
                $contraseña_verificada = md5($request->txtPassword); 
                
            }
        

                // Busqueda Usuario
            $nombre_existe = User::where('nombre_usuario', $request->txtUsuario )->count();     
            if($nombre_existe>=1){
                $obj_usuario = User::where('nombre_usuario', $request->txtUsuario )->first();
                if($obj_usuario->id == $request->txtId){
                    $email_existe = User::where('email_usuario', $request->txtEmail )->count();                    
                    if($email_existe>=1){                       
                        $obj_email = User::where('email_usuario', $request->txtEmail )->first();
                        if($obj_email->id == $request->txtId){         
                            $obj_usuario->nombre_usuario = $request->txtUsuario;
                            $obj_usuario->email_usuario = $request->txtEmail;
                            $obj_usuario->password_usuario = $contraseña_verificada;
                            $obj_usuario->rol_id = $request->selectRol;
                            $obj_usuario->sucursal_id = $request->selectSucursal;
                            $obj_usuario->estado_usuario = $request->txtEstado;
                            
                            try {
                                $obj_usuario->save();
                                return redirect(route('usuario.index'))->withErrors(['status' => "Se ha actualizado el usuario: ".$obj_usuario->nombre_usuario ]);
            
                            } catch (\Illuminate\Database\QueryException $qe) {
                                
                                return redirect()->back()->withErrors(['danger' => 'Usuario o Correo duplicados' ]);
                            } catch (Exception $e) {
                                return redirect()->back()->withErrors(['danger' => $e->getMessage()]);
                            } catch (\Throwable $th) {
                                return redirect()->back()->withErrors(['danger' => $th]);
                            }  
                            
                            
                        }else{
                            
                            return redirect()->back()->withErrors(['danger' => 'Ingreso un correo que ya esta en uso' ]);
                        }
                    
                    }else{
                        $obj_usuario->nombre_usuario = $request->txtUsuario;
                        $obj_usuario->email_usuario = $request->txtEmail;
                        $obj_usuario->password_usuario = $contraseña_verificada;
                        $obj_usuario->rol_id = $request->txtRol;
                        $obj_usuario->estado_usuario = $request->txtEstado;
                        try {
                            $obj_usuario->save();
                            return redirect(route('usuario.index'))->withErrors(['status' => "Se ha actualizado el usuario: ".$obj_usuario->nombre_usuario ]);
        
                        } catch (\Illuminate\Database\QueryException $qe) {
                            
                            return redirect()->back()->withErrors(['danger' => 'Usuario o Correo duplicados' ]);
                        } catch (Exception $e) {
                            return redirect()->back()->withErrors(['danger' => $e->getMessage()]);
                        } catch (\Throwable $th) {
                            return redirect()->back()->withErrors(['danger' => $th]);
                        } 
                    }
                
                }else{
                    return redirect()->back()->withErrors(['danger' => 'Ingreso un nombre que ya esta en uso' ]);
                }
            }else{
                
                $email_existe = User::where('email_usuario', $request->txtEmail )->count();
                if($email_existe>=1){
                    $obj_email = User::where('email_usuario', $request->txtEmail )->first();
                    if($obj_email->id == $request->txtId){         
                        $obj_usuario->nombre_usuario = $request->txtUsuario;
                        $obj_usuario->email_usuario = $request->txtEmail;
                        $obj_usuario->password_usuario = $contraseña_verificada;
                        $obj_usuario->rol_id = $request->txtRol;
                        $obj_usuario->estado_usuario = $request->txtEstado;
                        try {
                            $obj_usuario->save();
                            return redirect(route('usuario.index'))->withErrors(['status' => "Se ha actualizado el usuario: ".$obj_usuario->nombre_usuario ]);
        
                        } catch (\Illuminate\Database\QueryException $qe) {
                            
                            return redirect()->back()->withErrors(['danger' => 'Usuario o Correo duplicados' ]);
                        } catch (Exception $e) {
                            return redirect()->back()->withErrors(['danger' => $e->getMessage()]);
                        } catch (\Throwable $th) {
                            return redirect()->back()->withErrors(['danger' => $th]);
                        } 
                    }else{
                        return redirect()->back()->withErrors(['danger' => 'Ingreso un email que ya esta en uso' ]);
                    }
                
                }else{
                    return redirect()->back()->withErrors(['danger' => 'Ingreso un nombre que ya esta en uso' ]);
                }
            }

        }
        
              
        return redirect(route('index'));
        

    }

    public function desbloquear($id){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/usuario/delete')){

            $obj_usuario = User::find($id);
            $obj_usuario->estado_usuario = '1';

            $obj_usuario->save();
            return redirect(route('usuario.index'))->withErrors(['status' => "Se ha desbloqueado el usuario: ".$obj_usuario->nombre_usuario ]);

        }

        return redirect(route('index'));


    }

    public function delete($id){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/usuario/delete')){

            $obj_usuario = User::find($id);
            $obj_usuario->estado_usuario = '0';

            $obj_usuario->save();
            return redirect(route('usuario.index'))->withErrors(['status' => "Se ha desbloqueado el usuario: ".$obj_usuario->nombre_usuario ]);

        }

        return redirect(route('index'));


    }

}
