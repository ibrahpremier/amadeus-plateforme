<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom' => 'Kone',
            'prenom' => 'Moïse',
            'role' => 'super',
            'poste' => 'Administrateur',
            'email' => 'kone@example.com',
            'telephone' => "80000000",
            'password' => Hash::make('password'),
        ]);
        User::create([
            'nom' => 'Bamouni',
            'prenom' => 'Jonas Kevin',
            'role' => 'coordinateur',
            'poste' => 'Coordinateur',
            'email' => 'lenyborja1er@gmail.com',
            'telephone' => "56785580",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Coulibaly',
            'prenom' => 'Ibrahim',
            'role' => 'chef_cellule',
            'poste' => 'Chef de cellule',
            'email' => 'ibrahpremier@gmail.com',
            'telephone' => "80000000",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Kaboré',
            'prenom' => 'Elie',
            'role' => 'agent_cellule',
            'poste' => 'Agent de cellule',
            'email' => 'ibrahim@icloud.com',
            'telephone' => "80000000",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Zongo',
            'prenom' => 'Abdoul Aziz',
            'role' => 'agent_ministere',
            'poste' => 'Agent de ministère',
            'email' => 'bifag20846@operades.com',
            'telephone' => "80000000",
            'ministere_id' => 1,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Zida',
            'prenom' => 'François',
            'role' => 'agent_ministere',
            'poste' => 'Agent de ministère',
            'email' => 'zida@example.com',
            'telephone' => "80000000",
            'ministere_id' => 3,
            'password' => Hash::make('password'),
        ]);
    }
}
