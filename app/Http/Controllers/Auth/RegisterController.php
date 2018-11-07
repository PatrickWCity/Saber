<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Usuario;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'run' => 'max:10|unique:Usuario',
            'nombre' => 'required|string|max:60',
            'appat' => 'required|string|max:60',
            'apmat' => 'max:60',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|between:9,15|unique:Usuario',
            'username' => 'required|string|max:20|unique:Acceso',
            'email' => 'required|string|email|max:255|unique:Usuario',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $input = Usuario::create([
            'run' => $data['run'],
            'nombre' => $data['nombre'],
            'appat' => $data['appat'],
            'apmat' => $data['apmat'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
        ]);
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'diasClave' => '14',
            'fechaCaducidad' => Carbon::now()->addDays(14),
            'email' => $data['email'],
            'estadoInicial' => '1',
            'estadoAcceso' => null,
            'idUsuario' => $input->idUsuario,
        ]);
    }
}
