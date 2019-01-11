<?php

namespace App\Http\Controllers\API;

use DB;
use App\Profesion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfesionController extends Controller
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
        return Profesion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Profesion from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Profesion',
            'descripcion' => 'max:255'
        ]);

        $profesion = new Profesion;

        $profesion->nombre = $request->nombre;
        $profesion->descripcion = $request->descripcion;
        
        $profesion->save();

        return ['message' => 'La Profesión fue Ingresada con Exito!'];
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
        // Stores Profesion from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Profesion,idProfesion'.$request->id,
            'descripcion' => 'max:255'
        ]);

        $profesion = Profesion::find($id);

        $profesion->nombre = $request->nombre;
        $profesion->descripcion = $request->descripcion;

        $profesion->save();
        
        return ['message' => 'La Profesión fue Actualizada con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesion = Profesion::find($id);

        $profesion->delete();

        return ['message' => 'La Profesión fue Eliminada con Exito!'];
    }
}
