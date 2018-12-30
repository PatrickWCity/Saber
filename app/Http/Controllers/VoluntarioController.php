<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoVoluntario;
use App\Profesion;
use Carbon\Carbon;
use DB;

class VoluntarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('voluntarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoVoluntarios = TipoVoluntario::pluck('nombre', 'idTipoVoluntario');
        $profesiones = Profesion::pluck('nombre', 'idProfesion');
        return view('voluntarios.create')->with(compact('tipoVoluntarios', 'profesiones'));
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
            'email' => 'required|max:255|email|unique:Voluntario',
            'idTipoVoluntario' => 'sometimes', // ID not required
            'idProfesion' => 'sometimes'
        ]);
        $values =
        [
            $request->run,
            $request->nombre,
            $request->appat,
            $request->apmat,
            $request->direccion,
            $request->telefono,
            $request->email,
            Carbon::now(),
            $request->idTipoVoluntario,
            $request->idProfesion
        ];
        DB::insert('CALL sp_agregarVoluntario(?,?,?,?,?,?,?,?,?,?)', $values);

        return redirect('/voluntarios')->with('success', '¡Voluntario a sido Ingresado con Exito!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
