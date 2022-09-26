<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creando Roles predefinidos Administrador (supervisor) y Profesor
        DB::table('roles')->insert([
            'nombre' => 'Supervisor',
            'descripcion' => 'Rol que puede generar administrar notificaciones en el sistema.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Profesor',
            'descripcion' => 'Rol que se le asigna a los profesores.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
