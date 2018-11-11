<?php

namespace App\Http\Controllers\API;

use DB;
use App\Documento;
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
            'Documentos'       => DB::select('CALL sp_consultarTodosDocumento()'),
            'TipoDocumentos'   => DB::select('CALL sp_consultarTodosTipoDocumento()')
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
        if($request->archivo){
            $nombreArchivo = time().'.'.$request->archivo->getClientOriginalExtension();
            $request->archivo->move(public_path('docs/'), $nombreArchivo);
        }else{
            $nombreArchivo = '';
        }
        $values = 
        [ 
            $request->nombre,
            $request->descripcion,
            $nombreArchivo,
            Carbon::now(),
            null,
            $request->idTipoDocumento
        ];
        DB::insert('CALL sp_agregarDocumento(?,?,?,?,?,?)', $values);

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
        $numero = null;
        $numero = (int)$id;
        return DB::select('CALL sp_consultarUnDocumento(?,?)', [$numero,$id]);
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
            'archivo' => 'required|max:60|unique:Documento,idDocumento'.$request->id,
            'idTipoDocumento' => 'required',
        ]);
        $nombreArchivo = '';
        $documento = Documento::find($id);
        $currentArchivo = $documento->archivo;
        if($request->archivo != $currentArchivo && $request->archivo !=''){
            $nombreArchivo = time().'.'.$request->archivo->getClientOriginalExtension();
            $request->archivo->move(public_path('docs/'), $nombreArchivo);
            $DocumentoArchivo = public_path('img/noticias/').$currentArchivo;
            if(file_exists($DocumentoArchivo)){
                @unlink($DocumentoArchivo);
            }
        }else{
            $nombreArchivo = $currentArchivo;
        }
        $values = 
        [
            $id,
            $request->nombre,
            $request->descripcion,
            $nombreArchivo,
            $request->fechaCreada,
            Carbon::now(),
            $request->idTipoDocumento
        ];
        DB::update('CALL sp_actualizarDocumento(?,?,?,?,?,?,?)', $values);
        
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
        if(file_exists($documentoArchivo)){
            @unlink($documentoArchivo);
        }
        DB::delete('CALL sp_eliminarDocumento(?)', [$id]);
        return ['message' => 'El Documento fue Eliminado con Exito!'];
    }
}
