<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $data = [
            'Eventos'       => DB::select('CALL sp_consultarTodosEvento()'),
            'TipoEventos'   => DB::select('CALL sp_consultarTodosTipoEvento()'),
            'Sedes'         => DB::select('CALL sp_consultarTodosSede()'),
            'Areas'         => DB::select('CALL sp_consultarTodosArea()'),
            'Expositores'     => DB::select('CALL sp_consultarTodosExpositor()'),
            'Noticias'       => DB::select('CALL sp_consultarTodosNoticia()'),
            'TipoNoticias'   => DB::select('CALL sp_consultarTodosTipoNoticia()'),
            'Documentos'       => DB::select('CALL sp_consultarTodosDocumento()'),
            'TipoDocumentos'   => DB::select('CALL sp_consultarTodosTipoDocumento()')
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
