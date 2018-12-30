<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmoduloModuloController extends Controller
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
            'Modulos'          => DB::select('CALL sp_consultarTodosModulo()'),
            'SubmodulosSinModulo' => DB::select('CALL sp_consultarSubmodulosSinModulo(0)'),
            'SubmodulosDeModulo'  => DB::select('CALL sp_consultarSubmodulosDeModulo(0)')
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
            'idModulo' => 'required',
            'idSubmodulo' => 'required'
        ]);
        $values =
        [
            $request->idSubmodulo,
            $request->idModulo
        ];
        DB::insert('CALL sp_asignarSubmoduloAModulo(?,?)', $values);
        return ['message' => 'El Submódulo fue Asignado al Módulo con Exito!'];
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
            'Modulos'          => DB::select('CALL sp_consultarTodosModulo()'),
            'SubmodulosSinModulo' => DB::select('CALL sp_consultarSubmodulosSinModulo(?)', [$id]),
            'SubmodulosDeModulo'  => DB::select('CALL sp_consultarSubmodulosDeModulo(?)', [$id])
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
            'idModulo' => 'required',
            'idSubmodulo' => 'required'
        ]);
        $values =
        [
            $request->idSubmodulo,
            $request->idModulo
        ];
        DB::insert('CALL sp_desasignarSubmoduloDeModulo(?,?)', $values);
        return ['message' => 'El Submódulo fue Desasignado del Módulo con Exito!'];
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
