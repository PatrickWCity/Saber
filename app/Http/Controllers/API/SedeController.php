<?php

namespace App\Http\Controllers\API;

use DB;
use App\Sede;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SedeController extends Controller
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
        return DB::select('CALL sp_consultarTodosSede()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Sede from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Sede',
            'descripcion' => 'max:255',
            'ubicacion' => 'required|max:60|unique:Sede'
        ]);
        $values = 
        [ 
            $request->nombre,
            $request->descripcion,
            $request->ubicacion
        ];
        DB::insert('CALL sp_agregarSede(?,?,?)', $values);

        return ['message' => 'La Sede fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnSede(?,?)', [$numero,$id]);
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
        // Stores Sede from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Sede,idSede'.$request->id,
            'descripcion' => 'max:255',
            'ubicacion' => 'required|max:60|unique:Sede,idSede'.$request->id,
        ]);
        $values = 
        [
            $id,
            $request->nombre,
            $request->descripcion,
            $request->ubicacion
        ];
        DB::update('CALL sp_actualizarSede(?,?,?,?)', $values);
        
        return ['message' => 'La Sede fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarSede(?)', [$id]);
        return ['message' => 'La Sede fue Eliminado con Exito!'];
    }
}
