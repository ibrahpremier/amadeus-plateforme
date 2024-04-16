<?php

namespace Database\Factories;
// use App\Models\Reservation;
use App\Models\User;
// use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $depart = rand(0,150);
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'numero_dossier' => $this->faker->numerify('#######'),
            'numero_passport' => $this->faker->numerify('##########'),
            'ville_depart' => $this->faker->city,
            'ville_destination' => $this->faker->city,
            'date_depart' => $this->faker->dateTimeBetween('now', '+'.$depart.' day')->format('Y-m-d'),
            'date_retour' => $this->faker->dateTimeBetween('now', '+'.$depart+rand(2,30).' day')->format('Y-m-d'),
            'charge_de_mission_id' => 4,
            'agent_cellule_id' => null,
            'status' => $this->faker->randomElement(['traitement', 'approuvé', 'mission en cours','terminé']),
        ];
    }
}
