<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function random_african_name() {
        $names = ["Omar Diop", "Aminata Diallo", "Moussa Traoré", "Aïssatou Camara", "Abdoulaye Konaté", "Fatima Touré", "Amadou Barry", "Mariam Keita", "Modibo Cissé", "Adama Sow", "Bintou Coulibaly", "Sekou Traoré", "Nana Yaw", "N'diaye Diouf", "Fatoumata Sow", "Ousmane Sarr", "Mariama Ba", "Issa Koné", "Fatoumata Diop", "Kwame Mensah"];
        return $names[array_rand($names)];
    }

    public function random_african_destination() {
        $destinations = ["Casablanca", "Lagos", "Nairobi", "Abidjan", "Dakar", "Cairo", "Johannesburg", "Accra", "Kinshasa", "Maputo", "Lusaka", "Dar es Salaam", "Abuja", "Kampala", "Addis Ababa", "Bamako", "Lome", "Douala", "Harare"];
        return $destinations[array_rand($destinations)];
    }


    // for ($i = 1; $i <= $max; $i++) {
    //     $reservation = new Reservation();

    //     $reservation->id = $i;
    //     $reservation->num_dossier = rand(100000,999999);
    //     $reservation->date_depart = date('Y-m-d', strtotime("+".($i-1)." days"));
    //     $reservation->date_retour = date('Y-m-d', strtotime("+".$i." days"));
    //     $reservation->nom = $this->random_african_name();
    //     $reservation->destination = $this->random_african_destination();
    //     $reservation->status = $status_list[array_rand($status_list)];

    //     $reservations[] = $reservation;
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Reservation::query();
    
        if (getLoggedUser()->role == 'agent_ministere') {
            $query->where('charge_de_mission_id', getLoggedUser()->id)
                  ->where('active', 1);
        } elseif (getLoggedUser()->role == 'agent_cellule') {
            $query->where('agent_cellule_id', getLoggedUser()->id)
                  ->where('active', 1);
        }
    
        if ($request->has('new')) {
            $query->where("status", "nouveau");
        } elseif ($request->has('encours')) {
            $query->where("status", "mission en cours");
        } elseif ($request->has('ended')) {
            $query->where("status", "terminé");
        }
    
        $reservations = $query->get();
    
        return view('pages.reservation.reservation', compact('reservations'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.reservation.reservation-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $reservation_fake = new Reservation();

        $reservation_fake->id = 2;
        $reservation_fake->num_dossier = rand(100000,999999);
        $reservation_fake->num_passport = rand(10000,99999);
        $reservation_fake->date_depart = date('Y-m-d', strtotime("+10 days"));
        $reservation_fake->date_retour = date('Y-m-d', strtotime("+15 days"));
        $reservation_fake->nom = "Traoré Moussa";
        $reservation_fake->depart = "Ouagadougou";
        $reservation_fake->destination = "Nairobi";
        $reservation_fake->status = "traitement";

        return view('pages.reservation-detail',compact('reservation_fake'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reservation $reservation)
    {
        //
    }
}
