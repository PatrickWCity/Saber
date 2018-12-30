<?php

namespace App\Http\Controllers\API;

use DB;
use App\Voluntario;
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
            'Voluntarios'       => DB::select('CALL sp_consultarTodosVoluntario()'),
            'TipoVoluntarios'   => DB::select('CALL sp_consultarTodosTipoVoluntario()'),
            'Profesiones'         => DB::select('CALL sp_consultarTodosProfesion()')
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
        $numero = null;
        $numero = (int)$id;
        return DB::select('CALL sp_consultarUnVoluntario(?,?)', [$numero,$id]);
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
        $values =
        [
            $id,
            $request->run,
            $request->nombre,
            $request->appat,
            $request->apmat,
            $request->direccion,
            $request->telefono,
            $request->email,
            $request->fechaCreada,
            $request->idTipoVoluntario,
            $request->idProfesion
        ];
        DB::update('CALL sp_actualizarVoluntario(?,?,?,?,?,?,?,?,?,?,?)', $values);
        
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
        DB::delete('CALL sp_eliminarVoluntario(?)', [$id]);
        return ['message' => 'El Voluntario fue Eliminado con Exito!'];
    }
}
