<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('tipo_notificacions')->insert([            
            'descripcion' => 'Mensaje General',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_notificacions')->insert([            
            'descripcion' => 'Actividad',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_notificacions')->insert([            
            'descripcion' => 'Notificacion',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
