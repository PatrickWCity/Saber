<?php

namespace App\Http\Controllers\API;

use DB;
use App\Submodulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmoduloController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        //->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('CALL sp_consultarTodosSubmodulo()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Submodulo from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Submodulo',
            'descripcion' => 'max:255',
            'ubicacion' => 'required|max:60|unique:Submodulo'
        ]);
        $values = 
        [ 
            $request->nombre,
            $request->descripcion,
            $request->ubicacion
        ];
        DB::insert('CALL sp_agregarSubmodulo(?,?,?)', $values);

        return ['message' => 'El Submódulo fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnSubmodulo(?,?)', [$numero,$id]);
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
        // Stores Submodulo from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Submodulo',
            'descripcion' => 'max:255',
            'ubicacion' => 'required|max:60|unique:Submodulo'
        ]);
        $values = 
        [
            $id,
            $request->nombre,
            $request->descripcion,
            $request->ubicacion
        ];
        DB::update('CALL sp_actualizarSubmodulo(?,?,?,?)', $values);
        
        return ['message' => 'El Submódulo fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarSubmodulo(?)', [$id]);
        return ['message' => 'El Submódulo fue Eliminado con Exito!'];
    }
}
