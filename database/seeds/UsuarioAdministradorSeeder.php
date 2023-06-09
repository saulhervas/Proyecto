<?php

use Illuminate\Database\Seeder;
use App\Models\Seguridad\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = Usuario::create([
            'usuario' => 'root',
            'password' => 'root',
            'email' => 'proyecto.tfg1@gmail.com'
        ]);

        $usuario->roles()->sync(1);
    }
}
