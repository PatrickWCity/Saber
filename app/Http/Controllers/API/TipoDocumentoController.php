<?php

namespace App\Http\Controllers\API;

use DB;
use App\TipoDocumento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoDocumentoController extends Controller
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
        return DB::select('CALL sp_consultarTodosTipoDocumento()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores TipoDocumento from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:TipoDocumento',
            'descripcion' => 'max:255'
        ]);
        $values = 
        [ 
            $request->nombre,
            $request->descripcion
        ];
        DB::insert('CALL sp_agregarTipoDocumento(?,?)', $values);

        return ['message' => 'El Tipo de Documento fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnTipoDocumento(?,?)', [$numero,$id]);
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
        // Stores TipoDocumento from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:TipoDocumento,idTipoDocumento'.$request->id,
            'descripcion' => 'max:255'
        ]);
        $values = 
        [
            $id,
            $request->nombre,
            $request->descripcion
        ];
        DB::update('CALL sp_actualizarTipoDocumento(?,?,?)', $values);
        
        return ['message' => 'El Tipo de Documento fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarTipoDocumento(?)', [$id]);
        return ['message' => 'El Tipo de Documento fue Eliminado con Exito!'];
    }
}
