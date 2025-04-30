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
            $query->whereIn("status", ["nouveau", "affecté", "approuvé"]);
        } elseif ($request->has('encours')) {
            $query->whereIn("status", ["mission en cours", "traitement"]);
        } elseif ($request->has('ended')) {
            $query->where("status", "terminé");
        }

        $reservations = $query->orderBy("updated_at", "desc")->get();

        return view('pages.reservation.reservation', compact('reservations'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentYear = (int) date('Y');
        if (getLoggedUser()->role == 'agent_ministere') {

            $currentBudget = getLoggedUser()->ministere->budgets->where('annee_budgetaire', $currentYear)->first();
            if (!$currentBudget) {
                return redirect()->route('reservation.index')->with('error', 'Le budget de votre ministère pour l\'année en cours n\'est pas encore disponible. Contactez votre coordinateur.');
            }
            if ($currentBudget->solde <= 0) {
                return redirect()->route('reservation.index')->with('error', 'Le budget de votre ministère pour l\'année en cours est épuisé. Contactez votre coordinateur.');
            }
        }

        return view('pages.reservation.reservation-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'numero_passport' => 'required|string',
            'ville_depart' => 'required|string',
            'ville_destination' => 'required|string',
            'date_depart' => 'required|date',
            'date_retour' => 'required_if:type_voyage,aller_retour|nullable|date|after:date_depart',
            'classe' => 'required|in:economique,business,first',
            'visa' => 'required|boolean',
            'motif' => 'required|string',
            'type_voyage' => 'required|in:aller_simple,aller_retour',
            'file_passport' => 'nullable|file|mimes:jpeg,png,pdf|max:5120',
        ]);

        if (getLoggedUser()->role == 'chef_cellule') {
            $chef_cellule = getLoggedUser();
        } else if (getLoggedUser()->role == 'coordinateur') {
            $chef_cellule = User::where("role", "chef_cellule")->first();
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
        $reservation->visa = $request->visa;
        $reservation->type_voyage = $request->type_voyage;
        $reservation->commentaire = $request->commentaire;
        $reservation->charge_de_mission_id = getLoggedUser()->id;
        $reservation->chef_cellule_id = $chef_cellule->id ?? 0;
        $reservation->motif = $validated['motif'];


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
            'classe' => $reservation->classe,
            'reservation_id' => $reservation->id,
            'parent_ticket_id' => null,
        ]);

        if (getLoggedUser()->role == 'agent_ministere') {
            $coordo = User::where("role", "coordinateur")->first();
            $coordo->notify(new NewTicketNotification($ticket, false));
        } else if (getLoggedUser()->role == 'coordinateur') {
            $chef_cellule->notify(new NewTicketNotification($ticket, false));
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

        if ($reservation->ministere) {
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
        $chef_cellule = User::where("role", "chef_cellule")->first();
        if ($request->approve_for_agence) {
            $reservation->chef_cellule_id = $chef_cellule->id;
        } else {
            $reservation->agent_cellule_id = $request->agent_cellule;
        }
        $reservation->status = $request->status;
        $reservation->commentaire = $request->commentaire;
        $reservation->save();

        $ticket = Ticket::where("reservation_id", $reservation->id)->latest()->first();
        // dd($ticket);
        if ($request->status === 'affecté') {
            if ($ticket->status === 'nouveau') {
                $ticket->status = 'affecté';
                $ticket->save();
            }
        }

        if ($request->approve_for_agence) {
            $reservation->chef_cellule->notify(new NewTicketNotification($ticket, false));
        } else {
            $reservation->agent_cellule->notify(new NewTicketNotification($ticket, true));
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
