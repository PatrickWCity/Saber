<?php

namespace App\Http\Controllers\API;

use DB;
use App\Modulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuloController extends Controller
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
        return DB::select('CALL sp_consultarTodosModulo()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Modulo from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Modulo',
            'descripcion' => 'max:255'
        ]);
        $values =
        [
            $request->nombre,
            $request->descripcion
        ];
        DB::insert('CALL sp_agregarModulo(?,?)', $values);

        return ['message' => 'El Módulo fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnModulo(?,?)', [$numero,$id]);
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
        // Stores Modulo from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Modulo,idModulo'.$request->id,
            'descripcion' => 'max:255'
        ]);
        $values =
        [
            $id,
            $request->nombre,
            $request->descripcion
        ];
        DB::update('CALL sp_actualizarModulo(?,?,?)', $values);
        
        return ['message' => 'El Módulo fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarModulo(?)', [$id]);
        return ['message' => 'El Módulo fue Eliminado con Exito!'];
    }
}
