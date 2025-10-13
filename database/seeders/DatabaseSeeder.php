<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario de prueba para login
        User::create([
            'name' => 'Usuario Prueba',
            'email' => 'test@example.com',      // email para login
            'password' => bcrypt('secret123'),  // contraseña hasheada
        ]);

        // Insertar datos en tabla center
        DB::table('center')->insert([
            [
                'nom' => 'vallparadis',
                'email' => 'vallparadis@gmail.com',
                'telefon' => '123456789'
            ],
        ]);
    }
}
