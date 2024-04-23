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
            'nom' => 'Doe',
            'prenom' => 'John',
            'role' => 'super',
            'poste' => 'Administrateur',
            'email' => 'john.doe@example.com',
            'telephone' => "80000000",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Smith',
            'prenom' => 'Jane',
            'role' => 'chef_cellule',
            'poste' => 'Chef de cellule',
            'email' => 'jane.smith@example.com',
            'telephone' => "80000000",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Brown',
            'prenom' => 'Mike',
            'role' => 'agent_cellule',
            'poste' => 'Agent de cellule',
            'email' => 'mike.brown@example.com',
            'telephone' => "80000000",
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Johnson',
            'prenom' => 'Emily',
            'role' => 'agent_ministere',
            'poste' => 'Agent de ministère',
            'email' => 'emily.johnson@example.com',
            'telephone' => "80000000",
            'ministere_id' => 1,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Garcia',
            'prenom' => 'Alex',
            'role' => 'agent_ministere',
            'poste' => 'Agent de ministère',
            'email' => 'alex.garcia@example.com',
            'telephone' => "80000000",
            'ministere_id' => 3,
            'password' => Hash::make('password'),
        ]);
    }
}
