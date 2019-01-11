<?php

namespace App\Http\Controllers\API;

use DB;
use App\Voluntario;
use App\TipoVoluntario;
use App\Profesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoluntarioController extends Controller
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
            'Voluntarios'       => Voluntario::with(['tipovoluntario','profesion'])->get(),
            'TipoVoluntarios'   => TipoVoluntario::all(),
            'Profesiones'       => Profesion::all()
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
        // Stores Voluntario from Create View
        $this->validate($request, [
            'run' => 'max:10|nullable|unique:Voluntario',
            'nombre' => 'min:3|required|max:60',
            'appat' => 'min:3|required|max:60',
            'apmat' => 'max:60',
            'direccion' => 'required|max:255',
            'telefono' => 'required|between:9,15|unique:Voluntario',
            'email' => 'required|max:255|unique:Voluntario',
            'idTipoVoluntario' => 'sometimes', // ID not required
            'idProfesion' => 'sometimes'
        ]);

        $voluntario = new Voluntario;

        $voluntario->run = $request->run;
        $voluntario->nombre = $request->nombre;
        $voluntario->appat = $request->appat;
        $voluntario->apmat = $request->apmat;
        $voluntario->direccion = $request->direccion;
        $voluntario->telefono = $request->telefono;
        $voluntario->email = $request->email;
        $voluntario->fechaCreada = Carbon::now();
        $voluntario->idTipoVoluntario = $request->idTipoVoluntario;
        $voluntario->idProfesion = $request->idProfesion;
        
        $voluntario->save();

        return ['message' => 'El Voluntario fue Ingresado con Exito!'];
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
        // Stores Voluntario from Update View
        $this->validate($request, [
            'run' => 'max:10|unique:Voluntario,idVoluntario'.$request->id,
            'nombre' => 'required|max:60',
            'appat' => 'required|max:60',
            'apmat' => 'max:60',
            'direccion' => 'required|max:255',
            'telefono' => 'required|between:9,15|unique:Voluntario,idVoluntario'.$request->id,
            'email' => 'required|max:255|unique:Voluntario,idVoluntario'.$request->id
        ]);
        
        $voluntario =  Voluntario::find($id);

        $voluntario->run = $request->run;
        $voluntario->nombre = $request->nombre;
        $voluntario->appat = $request->appat;
        $voluntario->apmat = $request->apmat;
        $voluntario->direccion = $request->direccion;
        $voluntario->telefono = $request->telefono;
        $voluntario->email = $request->email;
        $voluntario->fechaCreada = $request->fechaCreada;
        $voluntario->idTipoVoluntario = $request->idTipoVoluntario;
        $voluntario->idProfesion = $request->idProfesion;
        
        $voluntario->save();
        
        return ['message' => 'El Voluntario fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voluntario = Voluntario::find($id);

        $voluntario->delete();

        return ['message' => 'El Voluntario fue Eliminado con Exito!'];
    }
}
