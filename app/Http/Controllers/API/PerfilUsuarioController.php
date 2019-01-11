<?php

namespace App\Http\Controllers\API;

use DB;
use App\Perfil;
use App\Usuario;
use App\PerfilUsuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilUsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$id = 0;
        //$id = DB::table('Perfil')->select('idPerfil')->first()->idPerfil;
        //if($id=null){
        //    $id = 0; // FIX if there's no Perfil then Return empty Perfil statement could be done on the client side but reuires uic fix on the api controller
        //}
        return $data = [
            'Perfiles'          => Perfil::all(),
            'UsuariosSinPerfil' => DB::table('Usuario')->whereNotIn('idUsuario', function($q){$q->select('idUsuario')->from('PerfilUsuario')->where('idPerfil', 0);})->get(),
            'UsuariosDePerfil'  => DB::table('Usuario')->join('PerfilUsuario', 'Usuario.idUsuario', '=', 'PerfilUsuario.idUsuario')->where('idPerfil', 0)->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'idPerfil' => 'required',
            'idUsuario' => 'required'
        ]);
        $perfilusuario = new PerfilUsuario;

        $perfilusuario->idUsuario = $request->idUsuario;
        $perfilusuario->idPerfil = $request->idPerfil;
        $perfilusuario->fecha = Carbon::now();
        $perfilusuario->estado = 1;
        
        $perfilusuario->save();

        //return redirect('/usuario')->with('success', 'Usuario Ingresado');
        //return $request->all();
        return ['message' => 'El Usuario fue Asignado al Perfil con Exito!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $data = [
            'Perfiles'          => Perfil::all(),
            'UsuariosSinPerfil' => DB::table('Usuario')->whereNotIn('idUsuario', function($q) use ($id) {$q->select('idUsuario')->from('PerfilUsuario')->where('idPerfil', $id);})->get(),
            'UsuariosDePerfil'  => DB::table('Usuario')->join('PerfilUsuario', 'Usuario.idUsuario', '=', 'PerfilUsuario.idUsuario')->where('idPerfil', $id)->get()
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'idPerfil' => 'required',
            'idUsuario' => 'required'
        ]);

        $perfilusuario = PerfilUsuario::where('idUsuario',$request->idUsuario)->where('idPerfil',$request->idPerfil);
        $perfilusuario->delete();

        return ['message' => 'El Usuario fue Desasignado del Perfil con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
