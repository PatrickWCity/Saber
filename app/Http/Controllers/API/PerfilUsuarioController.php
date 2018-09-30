<?php

namespace App\Http\Controllers\API;

use DB;
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
            'Perfiles'          => DB::select('CALL sp_consultarTodosPerfil()'),
            'UsuariosSinPerfil' => DB::select('CALL sp_consultarUsuariosSinPerfil(0)'),
            'UsuariosDePerfil'  => DB::select('CALL sp_consultarUsuariosDePerfil(0)')
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
        $values = 
        [ 
            
            $request->idUsuario,
            $request->idPerfil
        ];
        DB::insert('CALL sp_asignarUsuarioAPerfil(?,?)', $values);

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
            'Perfiles'          => DB::select('CALL sp_consultarTodosPerfil()'),
            'UsuariosSinPerfil' => DB::select('CALL sp_consultarUsuariosSinPerfil(?)',[$id]),
            'UsuariosDePerfil'  => DB::select('CALL sp_consultarUsuariosDePerfil(?)',[$id])
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
        $values = 
        [ 
            $request->idUsuario,
            $request->idPerfil
        ];
        DB::insert('CALL sp_desasignarUsuarioDePerfil(?,?)', $values);
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
