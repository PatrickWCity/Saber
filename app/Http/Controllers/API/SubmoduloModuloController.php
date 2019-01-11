<?php

namespace App\Http\Controllers\API;

use DB;
use App\Submodulo;
use App\Modulo;
use App\SubmoduloModulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmoduloModuloController extends Controller
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
            'Modulos'             => Modulo::all(),
            'SubmodulosSinModulo' => DB::table('Submodulo')->whereNotIn('idSubmodulo', function($q){$q->select('idSubmodulo')->from('SubmoduloModulo')->where('idModulo', 0);})->get(),
            'SubmodulosDeModulo'  => DB::table('Submodulo')->join('SubmoduloModulo', 'Submodulo.idSubmodulo', '=', 'SubmoduloModulo.idSubmodulo')->where('idModulo', 0)->get()
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
        $this->validate($request, [
            'idModulo' => 'required',
            'idSubmodulo' => 'required'
        ]);

        $submodulomodulo = new SubmoduloModulo;

        $submodulomodulo->idSubmodulo = $request->idSubmodulo;
        $submodulomodulo->idModulo = $request->idModulo;
        $submodulomodulo->fecha = Carbon::now();
        $submodulomodulo->estado = 1;
        
        $submodulomodulo->save();

        return ['message' => 'El Submódulo fue Asignado al Módulo con Exito!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $data = [
            'Modulos'             => Modulo::all(),
            'SubmodulosSinModulo' => DB::table('Submodulo')->whereNotIn('idSubmodulo', function($q) use ($id) {$q->select('idSubmodulo')->from('SubmoduloModulo')->where('idModulo', $id);})->get(),
            'SubmodulosDeModulo'  => DB::table('Submodulo')->join('SubmoduloModulo', 'Submodulo.idSubmodulo', '=', 'SubmoduloModulo.idSubmodulo')->where('idModulo', $id)->get()
        ];
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
        $this->validate($request, [
            'idModulo' => 'required',
            'idSubmodulo' => 'required'
        ]);

        $submodulomodulo = SubmoduloModulo::where('idSubmodulo',$request->idSubmodulo)->where('idModulo',$request->idModulo);
        $submodulomodulo->delete();

        return ['message' => 'El Submódulo fue Desasignado del Módulo con Exito!'];
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
