<?php

namespace App\Http\Controllers\API;

use DB;
use App\Documento;
use App\TipoDocumento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentoController extends Controller
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
            'Documentos'       => Documento::with('tipodocumento')->get(),
            'TipoDocumentos'   => TipoDocumento::all()
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
        // Stores Documento from Create View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Documento',
            'descripcion' => 'max:255',
            'archivo' => 'required|max:64000',
            'idTipoDocumento' => 'required' // ID not required
        ]);
        $nombreArchivo = '';
        if ($request->archivo) {
            $nombreArchivo = time().'.'.$request->archivo->getClientOriginalExtension();
            $request->archivo->move(public_path('docs/'), $nombreArchivo);
        } else {
            $nombreArchivo = '';
        }

        $documento = new Documento;

        $documento->nombre = $request->nombre;
        $documento->descripcion = $request->descripcion;
        $documento->archivo = $nombreArchivo;
        $documento->fechaCreada = Carbon::now();
        $documento->fechaActualizada = null;
        $documento->idTipoDocumento = $request->idTipoDocumento;
        
        $documento->save();

        return ['message' => 'El Documento fue Ingresado con Exito!'];
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
        // Stores Documento from Update View
        $this->validate($request, [
            'nombre' => 'required|max:60|unique:Documento,idDocumento'.$request->id,
            'descripcion' => 'max:255',
            'archivo' => 'required|max:64000|unique:Documento,idDocumento'.$request->id,
            'idTipoDocumento' => 'required',
        ]);
        $nombreArchivo = '';
        $documento = Documento::find($id);
        $currentArchivo = $documento->archivo;
        if ($request->archivo != $currentArchivo) {
            $nombreArchivo = time().'.'.$request->archivo->getClientOriginalExtension();
            $request->archivo->move(public_path('docs/'), $nombreArchivo);
            $DocumentoArchivo = public_path('docs/').$currentArchivo;
            if (file_exists($DocumentoArchivo)) {
                @unlink($DocumentoArchivo);
            }
        } else {
            $nombreArchivo = $currentArchivo;
        }

        $documento = Documento::find($id);

        $documento->nombre = $request->nombre;
        $documento->descripcion = $request->descripcion;
        $documento->archivo = $nombreArchivo;
        $documento->fechaCreada = $request->fechaCreada;
        $documento->fechaActualizada = Carbon::now();
        $documento->idTipoDocumento = $request->idTipoDocumento;
        
        $documento->save();
        
        return ['message' => 'El Documento fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);
        $currentArchivo = $documento->archivo;
        $documentoArchivo = public_path('docs/').$currentArchivo;
        if (file_exists($documentoArchivo)) {
            @unlink($documentoArchivo);
        }
        $documento = Documento::find($id);

        $documento->delete();
        
        return ['message' => 'El Documento fue Eliminado con Exito!'];
    }
}
