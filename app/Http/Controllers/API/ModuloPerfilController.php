<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuloPerfilController extends Controller
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
        return $data = [
            'Perfiles'          => DB::select('CALL sp_consultarTodosPerfil()'),
            'ModulosSinPerfil' => DB::select('CALL sp_consultarModulosSinPerfil(0)'),
            'ModulosDePerfil'  => DB::select('CALL sp_consultarModulosDePerfil(0)')
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
            'idModulo' => 'required'
        ]);
        $values =
        [
            
            $request->idModulo,
            $request->idPerfil
        ];
        DB::insert('CALL sp_asignarModuloAPerfil(?,?)', $values);
        return ['message' => 'El Modulo fue Asignado al Perfil con Exito!'];
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
            'ModulosSinPerfil' => DB::select('CALL sp_consultarModulosSinPerfil(?)', [$id]),
            'ModulosDePerfil'  => DB::select('CALL sp_consultarModulosDePerfil(?)', [$id])
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
            'idModulo' => 'required'
        ]);
        $values =
        [
            $request->idModulo,
            $request->idPerfil
        ];
        DB::insert('CALL sp_desasignarModuloDePerfil(?,?)', $values);
        return ['message' => 'El Modulo fue Desasignado del Perfil con Exito!'];
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
