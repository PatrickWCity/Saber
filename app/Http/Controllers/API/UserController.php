<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Usuario;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function actualizarCuenta(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request,[
            'username' => 'required|string|max:20|unique:Acceso,idUsuario'.$request->id,
            'email' => 'required|string|email|max:191|unique:Acceso,idUsuario'.$request->id,
            'password' => 'sometimes|required|min:6'
        ]);
        $currentPhoto = $user->foto;
        if($request->foto != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
            \Image::make($request->foto)->save(public_path('img/usuarios/').$name);
            $request->merge(['foto' => $name]);
            $userPhoto = public_path('img/usuarios/').$currentPhoto;
            if(file_exists($userPhoto)){
                if($currentPhoto != 'default.png'){
                    @unlink($userPhoto);
                }
            }
        }
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        $usuario = Usuario::find(auth('api')->user()->getIdUsuario());
        $usuario->email = $request->email;
        $usuario->save();
        $user->update($request->all());
        return ['message' => "Success"];
    }
    public function cuenta()
    {
        return $data = [
            'user' => auth('api')->user(),
            'usuario' => Usuario::find(auth('api')->user()->getIdUsuario())
        ];
    }
}