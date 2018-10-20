<?php

namespace App\Http\Controllers\API;

use DB;
use App\Expositor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpositorController extends Controller
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
        return DB::select('CALL sp_consultarTodosExpositor()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Expositor from Create View
        $this->validate($request, [
            'run' => 'max:10|nullable|unique:Expositor',
            'nombre' => 'min:3|required|max:60',
            'appat' => 'min:3|required|max:60',
            'apmat' => 'max:60'
        ]);
        $values = 
        [ 
            $request->run,
            $request->nombre,
            $request->appat,
            $request->apmat
        ];
        DB::insert('CALL sp_agregarExpositor(?,?,?,?)', $values);

        //return redirect('/usuario')->with('success', 'Expositor Ingresado');
        //return $request->all();
        return ['message' => 'El Expositor fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnExpositor(?,?)', [$numero,$id]);
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
        // Stores Expositor from Update View
        $this->validate($request, [
            'run' => 'max:10|unique:Expositor,idExpositor'.$request->id,
            'nombre' => 'required|max:60',
            'appat' => 'required|max:60',
            'apmat' => 'max:60'
        ]);
        $values = 
        [
            $id,
            $request->run,
            $request->nombre,
            $request->appat,
            $request->apmat
        ];
        DB::update('CALL sp_actualizarExpositor(?,?,?,?,?)', $values);
        
        return ['message' => 'El Expositor fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarExpositor(?)', [$id]);
        return ['message' => 'El Expositor fue Eliminado con Exito!'];
    }
}
