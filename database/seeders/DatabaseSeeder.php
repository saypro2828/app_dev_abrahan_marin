<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('12345678'),
            'remember_token' => '',
            'rol_user' => '0',
        ]);
        DB::table('depositos')->insert([
            'cod_deposito' => '00000001',
            'des_deposito' => 'DC',
            'estatus' => 'A'
        ]);
    }
}
