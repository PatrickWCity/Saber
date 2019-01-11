<?php

namespace App\Http\Controllers\API;

use DB;
use App\Evento;
use App\TipoEvento;
use App\Sede;
use App\Area;
use App\Expositor;
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
            'Eventos'       => Evento::with(['tipoevento','sede','area','expositor'])->get(),
            'TipoEventos'   => TipoEvento::all(),
            'Sedes'         => Sede::all(),
            'Areas'         => Area::all(),
            'Expositores'   => Expositor::all()
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

        $evento = new Evento;

        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->fechaInicio = $request->fechaInicio;
        $evento->fechaTermino = $request->fechaTermino;
        $evento->idTipoEvento = $request->idTipoEvento;
        $evento->idSede = $request->idSede;
        $evento->idArea = $request->idArea;
        $evento->idExpositor = $request->idExpositor;
        
        $evento->save();

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
        // Stores Evento from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Evento,idEvento'.$request->id,
            'descripcion' => 'max:255',
            'fechaInicio' => 'required|date',
            'fechaTermino' => 'required|date'
        ]);

        $evento = Evento::find($id);

        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->fechaInicio = $request->fechaInicio;
        $evento->fechaTermino = $request->fechaTermino;
        $evento->idTipoEvento = $request->idTipoEvento;
        $evento->idSede = $request->idSede;
        $evento->idArea = $request->idArea;
        $evento->idExpositor = $request->idExpositor;
        
        $evento->save();
        
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
        $evento = Evento::find($id);

        $evento->delete();

        return ['message' => 'El Evento fue Eliminado con Exito!'];
    }
}
