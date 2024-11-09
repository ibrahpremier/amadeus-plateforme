<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Ministere;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinisteresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ministeres = [
            'Ministère de la Santé',
            'Ministère de l\'Éducation',
            'Ministère de l\'Agriculture',
            'Ministère de la Défense',
            'Ministère de l\'Intérieur',
        ];

        DB::transaction(function () use ($ministeres) {
            foreach ($ministeres as $nom) {
                $ministere = Ministere::create(['nom' => $nom]);

                $dotation = random_int(100000, 10000000);

                Budget::create([
                    'dotation' => $dotation,
                    'solde' => $dotation,
                    'ministere_id' => $ministere->id,
                    'annee_budgetaire' => date('Y'),
                ]);
            }
        });
    }
}
