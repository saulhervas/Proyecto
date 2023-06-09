<?php

use App\Models\Personal;
use Illuminate\Database\Seeder;

class PersonalAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personal= Personal::create([
            'nombre' => 'Vicente',
            'apellidos' => 'Moral Moreno',
            'dni' => '12345678Z',
            'subir_dni' => '12345678Z.pdf',
            'foto' => '12345678Z.jpg',
            'sexo' => 'hombre',
            'fecha_nacimiento' => '1990-02-06',
            'telefono' => '665 665 665',
            'email_empresa' => 'proyecto.tfg1@gmail.es',
            'direccion' => 'Av. Constitucion, 12 2B',
            'codigo_postal' => 23640,
            'localidad' => 3588,
            'provincia' => 23,
            'pais' => 73,
            'usuario_id' => 1
        ]);
    }
}
