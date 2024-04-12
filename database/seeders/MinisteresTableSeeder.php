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
            'dotation_disponible' => '500000',
        ]);

        Ministere::create([
            'nom' => 'Ministère de l\'Éducation',
            'dotation_disponible' => '800000',
        ]);

        Ministere::create([
            'nom' => 'Ministère de l\'Agriculture',
            'dotation_disponible' => '600000',
        ]);

        Ministere::create([
            'nom' => 'Ministère de la Défense',
            'dotation_disponible' => '900000',
        ]);

        Ministere::create([
            'nom' => 'Ministère de l\'Intérieur',
            'dotation_disponible' => '700000',
        ]);
    }
}
