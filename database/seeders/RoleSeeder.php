<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rol1= Role::create(['name'=>'Administrador']);
        $rol2= Role::create(['name'=>'Empleado']);

        //permisos jefe de unidad
        Permission::create(['name'=>'crearUsuario'])->assignRole($rol1);
        Permission::create(['name'=>'editarUsuario'])->assignRole($rol1);
        Permission::create(['name'=>'verUusuario'])->assignRole($rol1);
        Permission::create(['name'=>'eliminarUsuario'])->assignRole($rol1);

    }
}
