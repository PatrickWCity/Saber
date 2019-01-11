<?php

namespace App\Http\Controllers\API;

use DB;
use App\Perfil;
use App\Modulo;
use App\ModuloPerfil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuloPerfilController extends Controller
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
            'Perfiles'         => Perfil::all(),
            'ModulosSinPerfil' => DB::table('Modulo')->whereNotIn('idModulo', function($q){$q->select('idModulo')->from('ModuloPerfil')->where('idPerfil', 0);})->get(),
            'ModulosDePerfil'  => DB::table('Modulo')->join('ModuloPerfil', 'Modulo.idModulo', '=', 'ModuloPerfil.idModulo')->where('idPerfil', 0)->get()
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
            'idPerfil' => 'required',
            'idModulo' => 'required'
        ]);

        $moduloperfil = new ModuloPerfil;

        $moduloperfil->idPerfil = $request->idPerfil;
        $moduloperfil->idModulo = $request->idModulo;
        $moduloperfil->fecha = Carbon::now();
        $moduloperfil->estado = 1;
        
        $moduloperfil->save();

        return ['message' => 'El Modulo fue Asignado al Perfil con Exito!'];
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
            'Perfiles'         => Perfil::all(),
            'ModulosSinPerfil' => DB::table('Modulo')->whereNotIn('idModulo', function($q) use ($id) {$q->select('idModulo')->from('ModuloPerfil')->where('idPerfil', $id);})->get(),
            'ModulosDePerfil'  => DB::table('Modulo')->join('ModuloPerfil', 'Modulo.idModulo', '=', 'ModuloPerfil.idModulo')->where('idPerfil', $id)->get()
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
            'idPerfil' => 'required',
            'idModulo' => 'required'
        ]);

        $moduloperfil = ModuloPerfil::where('idPerfil',$request->idPerfil)->where('idModulo',$request->idModulo);
        $moduloperfil->delete();

        return ['message' => 'El Modulo fue Desasignado del Perfil con Exito!'];
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
