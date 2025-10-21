<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//php artisan db:seed


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Usuario Prueba',
                'password' => bcrypt('secret123'),
            ]
        );

                // Similarly for center:
                DB::table('center')->updateOrInsert(
            ['email' => 'vallparadis@gmail.com'],
            [
                'nom' => 'vallparadis',
                'adreça' => 'Carrer de Vallparadis, 10',
                'telefon' => '123456789',
                'activo' => true,
            ]
        );

        DB::table('center')->updateOrInsert(
            ['email' => 'centrenord@gmail.com'],
            [
                'nom' => 'Centre Nord',
                'adreça' => 'Carrer Centre Nord, 5',
                'telefon' => '987654321',
                'activo' => true,
            ]
        );

        $vallparadisId = DB::table('center')->where('nom', 'vallparadis')->value('id');
        $centreNordId = DB::table('center')->where('nom', 'Centre Nord')->value('id');


        // Insert professionals linked to centers
        DB::table('profesional')->insert([
            [
                'id_center' => $vallparadisId,
                'nom' => 'Joan',
                'cognom' => 'Garcia',
                'telefon' => '600123456',
                'email' => 'joan.garcia@example.com',
                'taquilla' => 'A12',
                'adreça' => 'Carrer dels Professionals, 10',
                'talla_samarreta' => 'M',
                'talla_pantalons' => 'L',
                'talla_sabates' => '42',
                'data_renovacio' => Carbon::now()->subDays(10), // example date
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_center' => $centreNordId,
                'nom' => 'Maria',
                'cognom' => 'López',
                'telefon' => '600654321',
                'email' => 'maria.lopez@example.com',
                'taquilla' => 'B5',
                'adreça' => 'Avinguda dels Professionals, 20',
                'talla_samarreta' => 'S',
                'talla_pantalons' => 'M',
                'talla_sabates' => '38',
                'data_renovacio' => Carbon::now()->subDays(5),
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
 