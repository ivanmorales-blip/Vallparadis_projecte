<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('center')->insert([
            [
                'nom' => 'vallparadis',
                'email' => 'vallparadis@gmail.com',
                'telefon' => '123456789'
            ],
        ]);
    }
}
