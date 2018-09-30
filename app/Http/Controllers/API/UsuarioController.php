<?php

namespace App\Http\Controllers\API;
use DB;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        //->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('CALL sp_consultarTodosUsuario()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores Usuario from Create View
        $this->validate($request, [
            'run' => 'max:10|unique:Usuario',
            'nombre' => 'min:3|required|max:60',
            'appat' => 'min:3|required|max:60',
            'apmat' => 'max:60',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:20|unique:Usuario',
            'email' => 'required|max:255|unique:Usuario'
        ]);
        $values = 
        [ 
            $request->run,
            $request->nombre,
            $request->appat,
            $request->apmat,
            $request->direccion,
            $request->telefono,
            $request->email
        ];
        DB::insert('CALL sp_agregarUsuario(?,?,?,?,?,?,?)', $values);

        $username = substr($request->nombre, 0, 3).'.'.substr($request->appat, 0, 3);
        $counter = 0; 
        if (User::where('username', '=', $username)->exists()) {
            $counter += 1;
            $username = substr($request->nombre, 0, 3).'.'.substr($request->appat, 0, 3).$counter;
         }

        User::create([
            'username' => $username,
            'password' => Hash::make(substr($request->appat, 0, 3).'.'.substr($request->appat, 0, 3)),
            'diasClave' => '14',
            'fechaCaducidad' => Carbon::now()->addDays(14),
            'email' => $request['email'],
            'estadoInicial' => '1',
            'estadoAcceso' => null,
            'idUsuario' => Usuario::orderBy('idUsuario', 'desc')->first()->idUsuario,
        ]);
        //return redirect('/usuario')->with('success', 'Usuario Ingresado');
        //return $request->all();
        return ['message' => 'El Usuario fue Ingresado con Exito!'];
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
        return DB::select('CALL sp_consultarUnUsuario(?,?)', [$numero,$id]);
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
        // Stores Usuario from Create View
        $this->validate($request, [
            'run' => 'max:10|unique:Usuario',
            'nombre' => 'required|max:60',
            'appat' => 'required|max:60',
            'apmat' => 'max:60',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:20|unique:Usuario',
            'email' => 'required|max:255|unique:Usuario'
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
            $request->email
        ];
        DB::update('CALL sp_actualizarUsuario(?,?,?,?,?,?,?,?)', $values);
        
        return ['message' => 'El Usuario fue Actualizado con Exito!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('CALL sp_eliminarUsuario(?)', [$id]);
        return ['message' => 'El Usuario fue Eliminado con Exito!'];
    }
}