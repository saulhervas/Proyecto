<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Seguridad\Usuario;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\RegistersUsers as RegisterUsers;
use Illuminate\Support\Facades\Validator;

class RegistersUsers extends Controller
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

    use RegisterUsers;

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
     * Muestra la vista para logearse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seguridad.register');
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
            'usuario' => ['required', 'string', 'max:255','unique:usuario'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Seguridad\Usuario
     */
    protected function create(array $data)
    {
        $usuario = Usuario::create([
            'usuario' => $data['usuario'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $usuario->roles()->sync(3);

        $usuario->cliente()->create([
            'usuario_id' => $usuario->id,
            'nombre' => $usuario->usuario,
            'email' => $usuario->email
        ]);

        return $usuario;
    }

    /**
     * Establece la sesion del usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectTo()
    {
        $user = auth()->user();
        $roles = $user->roles()->orderBy('id')->get();
        if($roles[0]->nombre == 'cliente'){
            return '/web';
        }
    }
}
