<?php

namespace App\Http\Controllers\API;

use DB;
use App\Evento;
use App\TipoEvento;
use App\Sede;
use App\Area;
use App\Expositor;
use App\Noticia;
use App\TipoNoticia;
use App\Documento;
use App\TipoDocumento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $data = [
            'Eventos'        => Evento::count(),
            'TipoEventos'    => TipoEvento::count(),
            'Sedes'          => Sede::count(),
            'Areas'          => Area::count(),
            'Expositores'    => Expositor::count(),
            'Noticias'       => Noticia::count(),
            'TipoNoticias'   => TipoNoticia::count(),
            'Documentos'     => Documento::count(),
            'TipoDocumentos' => TipoDocumento::count()
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
        //
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
