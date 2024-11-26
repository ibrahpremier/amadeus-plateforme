<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Compagnie;
use App\Models\Ministere;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{

    public function random_african_name()
    {
        $names = ["Omar Diop", "Aminata Diallo", "Moussa Traoré", "Aïssatou Camara", "Abdoulaye Konaté", "Fatima Touré", "Amadou Barry", "Mariam Keita", "Modibo Cissé", "Adama Sow", "Bintou Coulibaly", "Sekou Traoré", "Nana Yaw", "N'diaye Diouf", "Fatoumata Sow", "Ousmane Sarr", "Mariama Ba", "Issa Koné", "Fatoumata Diop", "Kwame Mensah"];
        return $names[array_rand($names)];
    }

    public function random_african_destination()
    {
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
            $query->where('charge_de_mission_id', getLoggedUser()->id);
        } elseif (getLoggedUser()->role == 'agent_cellule') {
            $query->where('agent_cellule_id', getLoggedUser()->id);
        } elseif (getLoggedUser()->role == 'chef_cellule') {
            $query->where('chef_cellule_id', getLoggedUser()->id);
        }


        if ($request->has('new')) {
            $query->whereIn("status", ["nouveau", "affecté"]);
        } elseif ($request->has('encours')) {
            $query->where("status", "mission en cours");
        } elseif ($request->has('ended')) {
            $query->where("status", "terminé");
        }

        $reservations = $query->orderBy("created_at","desc")->get();

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
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'numero_passport' => 'required|string',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date',
            'ville_depart' => 'required|string',
            'ville_destination' => 'required|string',
            'file_passport' => 'nullable|file|mimes:jpeg,png,pdf|max:5120',
            'classe' => 'nullable',
            'visa' => 'required',
            'commentaire' => 'nullable'
        ]);

        // Vérifier si le rôle de l'utilisateur est 'chef_cellule' et récupérer l'ID
        // $IdChef = auth()->user()->role == 'chef_cellule' ? auth()->user()->id : null;

        if(getLoggedUser()->role == 'chef_cellule'){
            $chef_cellule = getLoggedUser();
        } else if(getLoggedUser()->role == 'coordinateur'){
            $chef_cellule = User::where("role","chef_cellule")->first();
        }

        $reservation = new Reservation();
        $reservation->nom = $request->nom;
        $reservation->prenom = $request->prenom;
        $reservation->numero_passport = $request->numero_passport;
        $reservation->ville_depart = $request->ville_depart;
        $reservation->ville_destination = $request->ville_destination;
        $reservation->date_depart = $request->date_depart;
        $reservation->date_retour = $request->date_retour;
        $reservation->classe = $request->classe;
        $reservation->commentaire = $request->commentaire;
        $reservation->charge_de_mission_id = getLoggedUser()->id;
        $reservation->chef_cellule_id = $chef_cellule->id ?? 0;


        if ($request->hasFile('file_passport')) {
            $file_passport = $request->file('file_passport');

            if ($file_passport->isValid()) {
                $photo_path = $file_passport->store('documents', 'public');
                $reservation->file_passport = $photo_path;
            } else {
                return redirect()->back()->with('error', 'Le fichier file_passport est invalide.');
            }
        }


        $reservation->save();
        $reservation->numero_dossier = date("Ym/") . $reservation->id;
        $reservation->save();

        // $ticket = rand(1000, 9999);

        $ticket = Ticket::create([
            'reponse_titre' => "Nouvelle demande",
            'reponse_message' => "Traitement",
            'reponse_ville_depart' => $reservation->ville_depart,
            'reponse_date_depart' => $reservation->date_depart,
            'reponse_ville_destination' => $reservation->ville_destination,
            'reponse_date_retour' => $reservation->date_retour,
            'reservation_id' => $reservation->id,
            'parent_ticket_id' => null,
        ]);

    if(getLoggedUser()->role == 'agent_ministere'){
        $coordo = User::where("role","coordinateur")->first();
        $coordo->notify(new NewTicketNotification($ticket,false));
    } 
    else if(getLoggedUser()->role == 'coordinateur') {
        $chef_cellule->notify(new NewTicketNotification($ticket,false));
    }
    
        return redirect()->route('reservation.index', ['new'])->with('success', 'Réservation créée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $agents_cellule = User::where("role", "agent_cellule")->get();
        $agences = Agence::latest()->get();
        $compagnies = Compagnie::latest()->get();
        
        if($reservation->ministere){
            $ministere = Ministere::where('id', $reservation->ministere->id)->first();
            return view(
                'pages.reservation.reservation-detail',
                compact('reservation', 'agents_cellule', 'agences', 'compagnies', 'ministere')
            );
        }
        return view(
            'pages.reservation.reservation-detail',
            compact('reservation', 'agents_cellule', 'agences', 'compagnies')
        );

        // dd($ministere);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            // 'agent_cellule' => 'required',
            'status' => 'required'
        ]);
        if($request->approve_for_agence){
            $reservation->chef_cellule_id = 3;
        } else {
            $reservation->status = $request->status;
            $reservation->agent_cellule_id = $request->agent_cellule;
            $reservation->commentaire = $request->commentaire;
        }
        $reservation->save();

        if ($request->status === 'affecté') {
            $ticket = Ticket::where("reservation_id", $reservation->id)->latest()->first();
            if ($ticket->status === 'nouveau') {
                $ticket->status = 'affecté';
                $ticket->save();
            }
        }

        if($request->approve_for_agence){
            $reservation->chef_cellule->notify(new NewTicketNotification($ticket,false));
        } else{
            $reservation->agent_cellule->notify(new NewTicketNotification($ticket,true));
        }

        return redirect()->route('reservation.show', $reservation->id)->with('success', 'Réservation affecté avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reservation $reservation)
    {
        //
    }

    public function genererBonCommande($id)
    {
        $reservation = Reservation::findOrFail($id);
        $pdf = Pdf::loadView('pdf.bon-commande', compact('reservation'));
        return $pdf->stream('bon_commande_billet_' . $reservation->id . '.pdf');
    }
}
