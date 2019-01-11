<?php

namespace App\Http\Controllers\API;

use DB;
use App\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
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
        return Area::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Area from Create View
        $this->validate($request, [
            'nombre' => 'required|max:191|unique:Area',
            'descripcion' => 'max:255'
        ]);
        
        $area = new Area;

        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;
        
        $area->save();

        return ['message' => 'La Area fue Ingresado con Exito!'];
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
        // Stores Area from Update View
        $this->validate($request, [
            'nombre' => 'required|max:191|unique:Area,idArea'.$request->id,
            'descripcion' => 'max:255'
        ]);

        $area = Area::find($id);

        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;

        $area->save();
        
        return ['message' => 'La Area fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        $area->delete();
        
        return ['message' => 'La Area fue Eliminado con Exito!'];
    }
}
