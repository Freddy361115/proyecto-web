<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $id= DB::table('users')->insertGetId([
            'name' => 'Supervisor Administrador',
            'email' => 'supervisor@administrador.com',
            'email_verified_at' => now(),
            'password' => Hash::make('super.admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('role_user')->insert([
            'role_id' =>1,
            'user_id' => $id            
        ]);
        

        
    }
}
