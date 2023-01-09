<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@c.com',
            'email_verified_at' => '',
            'password' => '12345678',
            'remember_token' => '',
            'created_at' => '',
            'updated_at' => '',
            'rol_user' => '0',
        ]);
        DB::table('depositos')->insert([
            'cod_deposito' => '00000001',
            'des_deposito' => 'DC',
            'estatus' => 'A'
        ]);
    }
}
