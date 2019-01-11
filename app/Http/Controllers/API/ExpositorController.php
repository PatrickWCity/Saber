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
        return Expositor::all();
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

        $expositor = new Expositor;

        $expositor->run = $request->run;
        $expositor->nombre = $request->nombre;
        $expositor->appat = $request->appat;
        $expositor->apmat = $request->apmat;
        
        $expositor->save();

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
        // Stores Expositor from Update View
        $this->validate($request, [
            'run' => 'max:10|unique:Expositor,idExpositor'.$request->id,
            'nombre' => 'required|max:60',
            'appat' => 'required|max:60',
            'apmat' => 'max:60'
        ]);

        $expositor = Expositor::find($id);

        $expositor->run = $request->run;
        $expositor->nombre = $request->nombre;
        $expositor->appat = $request->appat;
        $expositor->apmat = $request->apmat;
        
        $expositor->save();
        
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
        $expositor = Expositor::find($id);

        $expositor->delete();

        return ['message' => 'El Expositor fue Eliminado con Exito!'];
    }
}
