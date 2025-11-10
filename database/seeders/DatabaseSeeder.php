<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// php artisan migrate:fresh --seed

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Usuario Prueba',
                'password' => Hash::make('secret123'),
            ]
        );

        DB::table('center')->updateOrInsert(
            ['email' => 'vallparadis@gmail.com'],
            [
                'nom' => 'Vallparadis',
                'adreça' => 'Carrer de Vallparadis, 10',
                'telefon' => '123456789',
                'activo' => true,
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table('center')->updateOrInsert(
            ['email' => 'centrenord@gmail.com'],
            [
                'nom' => 'Centre Nord',
                'adreça' => 'Carrer Centre Nord, 5',
                'telefon' => '987654321',
                'activo' => true,
                'updated_at' => Carbon::now(),
            ]
        );

        $vallparadisId = DB::table('center')->where('nom', 'Vallparadis')->value('id');
        $centreNordId = DB::table('center')->where('nom', 'Centre Nord')->value('id');

        $professionals = [
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
                'data_renovacio' => Carbon::now()->subDays(10),
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
        ];

        foreach ($professionals as $prof) {
            DB::table('profesional')->updateOrInsert(
                ['email' => $prof['email']],
                $prof
            );
        }

        $joanId = DB::table('profesional')->where('nom', 'Joan')->value('id');
        $mariaId = DB::table('profesional')->where('nom', 'Maria')->value('id');

        DB::table('tracking')->insertOrIgnore([
            [
                'tipus' => 'Formació',
                'data' => Carbon::now()->subDays(2),
                'tema' => 'Sessió de formació en prevenció de riscos laborals',
                'comentari' => 'Joan va completar la formació amb una participació molt activa i interès notable.',
                'id_profesional' => $joanId,
                'id_profesional_registrador' => $mariaId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tipus' => 'Seguiment',
                'data' => Carbon::now()->subDay(),
                'tema' => 'Revisió del pla individual de treball',
                'comentari' => 'Maria ha mostrat una millora en la gestió del temps i la col·laboració amb l’equip.',
                'id_profesional' => $mariaId,
                'id_profesional_registrador' => $joanId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tipus' => 'Valoració',
                'data' => Carbon::now(),
                'tema' => 'Avaluació trimestral del rendiment professional',
                'comentari' => 'El rendiment general de Joan continua sent excel·lent, amb gran compromís i puntualitat.',
                'id_profesional' => $joanId,
                'id_profesional_registrador' => $mariaId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
