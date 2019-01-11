<?php

namespace App\Http\Controllers\API;

use DB;
use App\Perfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
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
        return Perfil::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Perfil from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Perfil',
            'descripcion' => 'max:255'
        ]);

        $perfil = new Perfil;

        $perfil->nombre = $request->nombre;
        $perfil->descripcion = $request->descripcion;
        
        $perfil->save();

        return ['message' => 'El Perfil fue Ingresado con Exito!'];
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
        // Stores Perfil from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Perfil,idPerfil'.$request->id,
            'descripcion' => 'max:255'
        ]);

        $perfil = Perfil::find($id);

        $perfil->nombre = $request->nombre;
        $perfil->descripcion = $request->descripcion;

        $perfil->save();
        
        return ['message' => 'El Perfil fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = Perfil::find($id);

        $perfil->delete();

        return ['message' => 'El Perfil fue Eliminado con Exito!'];
    }
}
