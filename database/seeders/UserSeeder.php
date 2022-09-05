<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->ciUsuario = '12345678';
        $user->primerNombre = 'Jose';
        $user->segundoNombre = 'Rivert';
        $user->apellidoPaterno = 'Pinto';
        $user->apellidoMaterno = 'Montaño';
        $user->genero = 'F';
        $user->expedido = 'CB';
        $user->fechaNacimiento = '1999/11/18';
        $user->email = 'josepinto12345678';
        $user->password = bcrypt('12345678');
        $user->telefono = 74326366;
        $user->activo = 1;
        $user->fechaInicio = '1990/02/05';
        $user->save();
        $user->assignRole('Administrador');

        $user = new User();
        $user->ciUsuario = '12347777';
        $user->primerNombre = 'Maria';
        $user->segundoNombre = 'Angela';
        $user->apellidoPaterno = 'Gutierrez';
        $user->apellidoMaterno = 'Montaño';
        $user->genero = 'F';
        $user->expedido = 'CB';
        $user->fechaNacimiento = '1999/11/18';
        $user->email = 'mariagutierrez12345678';
        $user->password = bcrypt('12345678');
        $user->telefono = 74326366;
        $user->activo = 1;
        $user->fechaInicio = '1999/02/05';
        $user->save();
        $user->assignRole('Empleado');

    }
}
