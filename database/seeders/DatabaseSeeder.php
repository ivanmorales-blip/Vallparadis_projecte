<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// Executar amb: php artisan migrate:fresh --seed

class DatabaseSeeder extends Seeder
{
    public function run(): void
    { 

        // -------------------------------------------------
        // 2️⃣ CENTRES
        // -------------------------------------------------
        DB::table('center')->updateOrInsert(
            ['email' => 'vallparadis@gmail.com'],
            [
                'nom' => 'Vallparadis',
                'adreça' => 'Carrer de Vallparadis, 10',
                'telefon' => '123456789',
                'activo' => true,
                'created_at' => Carbon::now(),
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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $vallparadisId = DB::table('center')->where('nom', 'Vallparadis')->value('id');
        $centreNordId = DB::table('center')->where('nom', 'Centre Nord')->value('id');

        // -------------------------------------------------
            // 1️⃣ USUARI DE PROVA
            // -------------------------------------------------
            User::updateOrCreate(
                ['email' => 'test@example.com'],
                [
                    'name' => 'Usuari Prova',
                    'password' => Hash::make('secret123'),
                    'id_center' => $vallparadisId, // assign a center here
                ]
            );


        // -------------------------------------------------
        // 3️⃣ PROFESSIONALS
        // -------------------------------------------------
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
                'id_center' => $vallparadisId,
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

        // -------------------------------------------------
        // 4️⃣ TRACKINGS
        // -------------------------------------------------
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
        ]);

        // -------------------------------------------------
        // 5️⃣ PROJECTES I COMISSIONS
        // -------------------------------------------------
        DB::table('projectes_comissions')->insertOrIgnore([
            [
                'nom' => 'Projecte Innovació 2025',
                'tipus' => 'projecte',
                'data_inici' => Carbon::now()->subDays(30),
                'profesional_id' => $joanId,
                'descripcio' => 'Projecte centrat en noves metodologies digitals.',
                'observacions' => 'Primera fase completada.',
                'centre_id' => $vallparadisId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Comissió de Benestar Laboral',
                'tipus' => 'comissio',
                'data_inici' => Carbon::now()->subDays(15),
                'profesional_id' => $mariaId,
                'descripcio' => 'Promoure el benestar dins del centre.',
                'observacions' => 'Reunions setmanals.',
                'centre_id' => $vallparadisId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // -------------------------------------------------
        // 6️⃣ CURSOS (TRAININGS)
        // -------------------------------------------------
        DB::table('training')->insertOrIgnore([
            [
                'nom_curs' => 'Formació en Gestió del Temps',
                'data_inici' => Carbon::now()->subDays(10),
                'data_fi' => Carbon::now()->addDays(20),
                'hores' => 30,
                'objectiu' => 'Millorar la productivitat i la planificació diària del personal.',
                'descripcio' => 'Curs pràctic amb sessions teòriques i exercicis sobre gestió eficient del temps.',
                'formador' => 'Anna Puig',
                'id_center' => $vallparadisId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom_curs' => 'Introducció a la Intel·ligència Artificial a Educació',
                'data_inici' => Carbon::now()->subDays(5),
                'data_fi' => Carbon::now()->addDays(25),
                'hores' => 40,
                'objectiu' => 'Explorar les aplicacions de la IA en l’àmbit educatiu.',
                'descripcio' => 'Tallers pràctics sobre IA aplicada a l’aprenentatge personalitzat.',
                'formador' => 'Jordi Riera',
                'id_center' => $vallparadisId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom_curs' => 'Curs d’Actualització en Seguretat Laboral',
                'data_inici' => Carbon::now()->addDays(3),
                'data_fi' => Carbon::now()->addDays(30),
                'hores' => 20,
                'objectiu' => 'Revisar protocols de seguretat i primers auxilis.',
                'descripcio' => 'Sessions teòriques i pràctiques sobre riscos laborals i emergències.',
                'formador' => 'Carla Soler',
                'id_center' => $centreNordId,
                'estat' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
