<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoNotificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Agregando tipos de notificacion por default;
        DB::table('roles')->insert([            
            'descripcion' => 'Mensaje General',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([            
            'descripcion' => 'Actividad',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([            
            'descripcion' => 'Notificacion',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
