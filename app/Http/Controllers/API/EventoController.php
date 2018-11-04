<?php

namespace App\Http\Controllers\API;

use DB;
use App\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventoController extends Controller
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
            'Eventos'       => DB::select('CALL sp_consultarTodosEvento()'),
            'TipoEventos'   => DB::select('CALL sp_consultarTodosTipoEvento()'),
            'Sedes'         => DB::select('CALL sp_consultarTodosSede()'),
            'Areas'         => DB::select('CALL sp_consultarTodosArea()'),
            'Expositores'     => DB::select('CALL sp_consultarTodosExpositor()')
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
        // Stores Evento from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Evento',
            'descripcion' => 'max:255',
            'fechaInicio' => 'required|date',
            'fechaTermino' => 'required|date',
            'idTipoEvento' => 'sometimes', // ID not required
            'idSede' => 'sometimes', // ID not required
            'idArea' => 'sometimes', // ID not required
            'idExpositor' => 'sometimes' // ID not required
        ]);
        $values = 
        [ 
            $request->nombre,
            $request->descripcion,
            $request->fechaInicio,
            $request->fechaTermino,
            $request->idTipoEvento,
            $request->idSede,
            $request->idArea,
            $request->idExpositor
        ];
        DB::insert('CALL sp_agregarEvento(?,?,?,?,?,?,?,?)', $values);

        return ['message' => 'El Evento fue Ingresado con Exito!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $numero = null;
        $numero = (int)$id;
        return DB::select('CALL sp_consultarUnEvento(?,?)', [$numero,$id]);
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
        // Stores Evento from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Evento,idEvento'.$request->id,
            'descripcion' => 'max:255',
            'fechaInicio' => 'required|date',
            'fechaTermino' => 'required|date'
        ]);
        $values = 
        [
            $id,
            $request->nombre,
            $request->descripcion,
            $request->fechaInicio,
            $request->fechaTermino,
            $request->idTipoEvento,
            $request->idSede,
            $request->idArea,
            $request->idExpositor
        ];
        DB::update('CALL sp_actualizarEvento(?,?,?,?,?,?,?,?,?)', $values);
        
        return ['message' => 'El Evento fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarEvento(?)', [$id]);
        return ['message' => 'El Evento fue Eliminado con Exito!'];
    }
}
