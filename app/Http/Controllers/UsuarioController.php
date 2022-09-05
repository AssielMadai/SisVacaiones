<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:verUusuario')->only('verListaUsuario');
        $this->middleware('can:editarUsuario')->only('mostrarEditarRegistro','editarUsuario');
        $this->middleware('can:crearUsuario')->only('vistaCrearUsuario','registrarUsuario');
        $this->middleware('can:eliminarUsuario')->only('eliminarUsuario');
    }
    public function vistaCrearUsuario(){

        $roles=DB::select("select roles.name as nombre, id as id
from roles
order by name asc;");
        return view('usuario.crearUsuarioVista', compact('roles'));
    }

    public function registrarUsuario(Request $request){

        $nombre = $request->input('primerNombre');
        $apellido = $request->input('apellidoPaterno');
        $ci = $request->input('CI');
        $us = $nombre.$apellido.$ci;
        $fechaFormato = $request->input('fechaInicio');

        $usuario= new User();
        $usuario->ciUsuario = $request->input('CI');
        $usuario->primerNombre = ucwords($request->input('primerNombre'));
        $usuario->segundoNombre = ucwords($request->input('segundoNombre'));
        $usuario->apellidoPaterno = ucwords($request->input('apellidoPaterno'));
        $usuario->apellidoMaterno = ucwords($request->input('apellidoMaterno'));
        $usuario->genero = $request->input('select-genero');
        $usuario->expedido= $request->input('select-Expedido');
        $usuario->telefono = $request->input('telefono');
        $usuario->activo = $request->input('activo');
        $usuario->email =strtolower($us);
        $usuario->password = bcrypt($ci);
        $usuario->fechaInicio = date('Y-m-d', strtotime($fechaFormato));
        $usuario->save();
        $usuario->assignRole($request->input('select-rol'));

        return redirect()->route('verListaUsuario')->with('registro', 'Usuario Registrado Exitosamente');
    }

    public function verListaUsuario(){

        $user = DB::select(" select concat_ws(' ', primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno) as nombre,
        concat_ws(' ',ciUsuario,expedido) as ci, activo  as estado, r.name as rol, users.id as id
    from users
     join model_has_roles
     join roles r on model_has_roles.role_id = r.id
 where users.id=model_id;");

        return view('usuario.verUsuarios', compact('user'));
    }

    public function mostrarEditarRegistro($id){
        $findRole = DB::select("select r.id as idRol, r.name
from users u
join model_has_roles
join roles r on model_has_roles.role_id = r.id
where u.id=model_id
and u.id=$id;");
        $roles = DB::select("select id, name from roles order by name asc ;");
        $user = User::find($id);
        $count = 1;

        return view('usuario.mostrarEditarUsuario',compact('findRole','roles','user','count'));
    }

    public function editarUsuario(Request $request,$id){

        $nombre = $request->input('primerNombre');
        $apellido = $request->input('apellidoPaterno');
        $ci = $request->input('ci');
        $us = $nombre.$apellido.$ci;
        $rol = $request->input('idRol');

        $usuario = User::find($id);
        $usuario->primerNombre = ucwords($request->input('primerNombre'));
        $usuario->segundoNombre = ucwords($request->input('segundoNombre'));
        $usuario->apellidoPaterno = ucwords($request->input('apellidoPaterno'));
        $usuario->apellidoMaterno = ucwords($request->input('ApellidoMaterno'));
        $usuario->ciUsuario = $request->input('ci');
        $usuario->fechaNacimiento = $request->input('fechaNacimiento');
        $usuario->telefono = $request->input('telefono');
        $usuario->genero = $request->input('genero');
        $usuario->activo = $request->input('activo');
        $usuario->email =strtolower($us);
        $usuario->password = bcrypt($ci);
        $usuario->assignRole($rol);
        $usuario->save();

        return redirect()->route('verListaUsuario')->with('registro', 'Usuario Editado Exitosamente');
    }

    public function eliminarUsuario($id){
        User::find($id)->delete();
        return redirect()->route('verListaUsuario')->with('registro', 'Usuario Eliminado Exitosamente');
    }
}
