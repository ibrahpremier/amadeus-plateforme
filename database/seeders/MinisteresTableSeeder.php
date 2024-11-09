<?php

namespace Database\Seeders;

use App\Models\Ministere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinisteresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ministere::create([
            'nom' => 'Ministère de la Santé',

        ]);

        Ministere::create([
            'nom' => 'Ministère de l\'Éducation',
        ]);

        Ministere::create([
            'nom' => 'Ministère de l\'Agriculture',
        ]);

        Ministere::create([
            'nom' => 'Ministère de la Défense',
        ]);

        Ministere::create([
            'nom' => 'Ministère de l\'Intérieur',
        ]);
    }
}
