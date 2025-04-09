<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\rol;
use App\Models\sucursal;
use Illuminate\Validation\Rule;
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
            $obj_usuario->primer_nombre_usuario = $request->txtNameUsuario;
            $obj_usuario->apellido_usuario = $request->txtLastName;
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
                return redirect()->back()->withErrors(['danger' => $qe->getMessage() ]);
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

        if (!Auth::check()) {
            Session::put('url', url()->current());
            return redirect(route('login.index'));
        }
    
        // Verificar permisos
        if (!Auth::user()->accesoRuta('/usuario/update')) {
            return redirect(route('index'));
        }
    
        // Buscar usuario
        $obj_usuario = User::find($request->txtId);
        if (!$obj_usuario) {
            return redirect()->back()->withErrors(['danger' => 'Usuario no encontrado']);
        }
    
        // Verificar si la contraseña cambió
        $contraseña_verificada = ($request->txtPassword === $obj_usuario->password_usuario)
            ? $obj_usuario->password_usuario
            : md5($request->txtPassword);
    
        // Validación de unicidad en nombre y correo
        $existe_nombre = User::where('nombre_usuario', $request->txtUsuario)
            ->where('id', '!=', $request->txtId)
            ->exists();
    
        if ($existe_nombre) {
            return redirect()->back()->withErrors(['danger' => 'El nombre de usuario ya está en uso']);
        }
    
        $existe_email = User::where('email_usuario', $request->txtEmail)
            ->where('id', '!=', $request->txtId)
            ->exists();
    
        if ($existe_email) {
            return redirect()->back()->withErrors(['danger' => 'El email ya está en uso']);
        }
    
        // Actualizar usuario
        try {

            $obj_usuario->nombre_usuario = $request->txtUsuario;
            $obj_usuario->email_usuario = $request->txtEmail;
            $obj_usuario->password_usuario = $contraseña_verificada;
            $obj_usuario->rol_id = $request->selectRol;
            $obj_usuario->sucursal_id = $request->selectSucursal;
            $obj_usuario->estado_usuario = $request->txtEstado;
          
            $obj_usuario->save();
    
            return redirect(route('usuario.index'))
                ->withErrors(['status' => "Se ha actualizado el usuario: " . $obj_usuario->nombre_usuario]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['danger' => 'Error al actualizar: ' . $e->getMessage()]);
        }

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
            return redirect(route('usuario.index'))->withErrors(['status' => "Se ha bloqueado el usuario: ".$obj_usuario->nombre_usuario ]);

        }

        return redirect(route('index'));


    }

    public function updatePassword(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        $m5PasswordViejo = md5($request->txtOld);

        if ($request->txtNew != $request->txtReNew) {
            
            return redirect()->back()->withErrors(['danger' => "no coinciden la nueva contraseña con la confirmacion." ]);

        }

        if (Auth::user()->password_usuario != $m5PasswordViejo) {

            return redirect()->back()->withErrors(['danger' => "no esta ingresando correctamente la contraseña anterior" ]);
            
        }

        $usuario = Auth::user();
        $usuario->password_usuario = md5($request->txtReNew);
        $usuario->save();
     
        return redirect()->back()->withErrors(['status' => "se ha actualizado correctamente la contraseña" ]);
    }

}
