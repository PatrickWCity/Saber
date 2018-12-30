<?php

namespace App\Http\Controllers\API;

use DB;
use App\Noticia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticiaController extends Controller
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
            'Noticias'       => DB::select('CALL sp_consultarTodosNoticia()'),
            'TipoNoticias'   => DB::select('CALL sp_consultarTodosTipoNoticia()')
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
        // Stores Noticia from Create View
        $this->validate($request, [
            'titulo' => 'required|max:191|unique:Noticia',
            'contenido' =>'required',
            //'imagenPortada' => 'max:2000',
            'idTipoNoticia' => 'required' // ID not required
        ]);
        $nombreImagenPortada = ''; // ? test if not needed
        if ($request->imagenPortada) {
            $nombreImagenPortada = time().'.' . explode('/', explode(':', substr($request->imagenPortada, 0, strpos($request->imagenPortada, ';')))[1])[1];
            \Image::make($request->imagenPortada)->save(public_path('img/noticias/').$nombreImagenPortada);
        } else {
            $nombreImagenPortada = 'default.png';
        }
        $values =
        [
            $request->titulo,
            $request->contenido,
            $nombreImagenPortada,
            Carbon::now(),
            null,
            $request->idTipoNoticia
        ];
        DB::insert('CALL sp_agregarNoticia(?,?,?,?,?,?)', $values);

        return ['message' => 'El Noticia fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnNoticia(?,?)', [$numero,$id]);
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
        // Stores Noticia from Update View
        $this->validate($request, [
            'titulo' => 'required|max:191|unique:Noticia,idNoticia'.$request->id,
            'contenido' =>'required',
            //'imagenPortada' => 'max:2000',
            'idTipoNoticia' => 'required',
        ]);
        $nombreImagenPortada = ''; // ? test if not needed
        $noticia = Noticia::find($id);
        $currentImagenPortada = $noticia->imagenPortada;
        if ($request->imagenPortada != $currentImagenPortada) {
            $nombreImagenPortada = time().'.' . explode('/', explode(':', substr($request->imagenPortada, 0, strpos($request->imagenPortada, ';')))[1])[1];
            \Image::make($request->imagenPortada)->save(public_path('img/noticias/').$nombreImagenPortada);
            $noticiaImagenPortada = public_path('img/noticias/').$currentImagenPortada;
            if (file_exists($noticiaImagenPortada)) {
                if ($currentImagenPortada != 'default.png') {
                    @unlink($noticiaImagenPortada);
                }
            }
        } else {
            $nombreImagenPortada = $currentImagenPortada;
        }
        $values =
        [
            $id,
            $request->titulo,
            $request->contenido,
            $nombreImagenPortada,
            $request->fechaCreada,
            Carbon::now(),
            $request->idTipoNoticia
        ];
        DB::update('CALL sp_actualizarNoticia(?,?,?,?,?,?,?)', $values);
        
        return ['message' => 'El Noticia fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        $currentImagenPortada = $noticia->imagenPortada;
        $noticiaImagenPortada = public_path('img/noticias/').$currentImagenPortada;
        if (file_exists($noticiaImagenPortada)) {
            if ($currentImagenPortada != 'default.png') {
                @unlink($noticiaImagenPortada);
            }
        }
        DB::delete('CALL sp_eliminarNoticia(?)', [$id]);
        return ['message' => 'El Noticia fue Eliminado con Exito!'];
    }
}
