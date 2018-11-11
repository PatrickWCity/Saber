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
            'ubicacion' => 'required|max:64000',
            'idTipoDocumento' => 'required' // ID not required
        ]);
        $imageName = '';
        if($request->ubicacion){
            $imageName = time().'.'.$request->ubicacion->getClientOriginalExtension();
            $request->ubicacion->move(public_path('docs/'), $imageName);
        }else{
            $imageName = '';
        }
        $values = 
        [ 
            $request->nombre,
            $request->descripcion,
            $imageName,
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
            'ubicacion' => 'required|max:60|unique:Documento,idDocumento'.$request->id,
            'idTipoDocumento' => 'required',
        ]);
        $imageName = '';
        $documento = Documento::find($id);
        $currentUbicacion = $documento->ubicacion;
        if($request->ubicacion != $currentUbicacion && $request->ubicacion !=''){
            $imageName = time().'.'.$request->ubicacion->getClientOriginalExtension();
            $request->ubicacion->move(public_path('docs/'), $imageName);
            $DocumentoUbicacion = public_path('img/noticias/').$currentUbicacion;
            if(file_exists($DocumentoUbicacion)){
                @unlink($DocumentoUbicacion);
            }
        }else{
            $imageName = $currentUbicacion;
        }
        $values = 
        [
            $id,
            $request->nombre,
            $request->descripcion,
            $imageName,
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
        $currentUbicacion = $documento->ubicacion;
        $documentoUbicacion = public_path('docs/').$currentUbicacion;
        if(file_exists($documentoUbicacion)){
            @unlink($documentoUbicacion);
        }
        DB::delete('CALL sp_eliminarDocumento(?)', [$id]);
        return ['message' => 'El Documento fue Eliminado con Exito!'];
    }
}
