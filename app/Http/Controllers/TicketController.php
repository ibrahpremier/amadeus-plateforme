<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Notifications\ReceiveResponseTicketNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // methode store d'un nouveua ticket
    public function store(Request $request)
    {
        $change = [];

        // Validation des champs
        $request->validate([
            'reponse_date_depart' => 'required|date',
            'reponse_date_retour' => 'required|date',
            'reponse_ville_depart' => 'required|string',
            'reponse_ville_destination' => 'required|string',
            'reponse_file' => 'nullable|file|mimes:jpeg,png,pdf|max:5120',
            'commentaire' => 'nullable|string',
            'prix' => 'nullable|string',
            'status' => 'required|string|in:nouveau,affecté,traité,en cours,non disponible,approuvé,refusé,annulé,terminé',
            'reservation_id' => 'required|exists:reservations,id',
            'charge_de_mission_id' => 'required',
            'parent_ticket_id' => 'nullable|exists:tickets,id',
        ]);
        // dd($request->all());

        // Formater les dates en français avec Carbon
        Carbon::setLocale('fr');
        $formattedDateDepart = Carbon::parse($request->reponse_date_depart)->isoFormat('D MMMM YYYY');
        $formattedDateRetour = Carbon::parse($request->reponse_date_retour)->isoFormat('D MMMM YYYY');

        // Création du nouveau ticket
        $ticket = new Ticket();
        $ticket->reponse_date_depart = $request->reponse_date_depart;
        $ticket->reponse_date_retour = $request->reponse_date_retour;
        $ticket->reponse_ville_depart = $request->reponse_ville_depart;
        $ticket->reponse_ville_destination = $request->reponse_ville_destination;
        $ticket->response_commentaire = $request->commentaire;
        $ticket->prix = $request->prix;
        $ticket->status = $request->status;
        $ticket->reservation_id = $request->reservation_id;
        $ticket->parent_ticket_id = $request->parent_ticket_id;
        $ticket->agence_id = $request->charge_de_mission_id;
        $ticket->agent_cellule_id = getLoggedUser()->id;

        // Gestion du fichier s'il est présent
        if ($request->hasFile('reponse_file')) {
            $reponse_file = $request->file('reponse_file');
            if ($reponse_file->isValid()) {
                $photo_path = $reponse_file->store('documents', 'public');
                $ticket->reponse_file = $photo_path;
            } else {
                return redirect()->back()->with('error', 'Le fichier est invalide.');
            }
        }

        if ($request->filled('oldTicket')) {
            $oldTicket = Ticket::where('id', $request->oldTicket)->first();
            $oldTicket->status = 'traité';
            $oldTicket->save();
        }

        // // Associer le ticket à une réservation et mettre à jour le statut de la réservation
        // $reservation = Reservation::find($request->reservation_id);
        // if ($reservation) {
        //     $ticket->reservation()->associate($reservation);
        // }

        $ticket->save();

        // Redirection avec succès et les changements
        return redirect()->route('reservation.show', $ticket->reservation->id)
            ->with('success', 'Nouveau ticket créé');
    }



    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Validation du fichier si nécessaire
        $request->validate([
            'reponse_billet' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Autorise les fichiers images et pdf de max 2 Mo
            'status' => 'sometimes|required|string|in:nouveau,affecté,traité,en cours,non disponible,approuvé,refusé,annulé,terminé',
            'agence_id' => 'sometimes|required|exists:agences,id',
            'compagnie_id' => 'sometimes|required|exists:compagnies,id'
        ]);

        // Gestion du fichier s'il est présent
        if ($request->hasFile('reponse_billet')) {
            $reponse_file = $request->file('reponse_billet');
            if ($reponse_file->isValid()) {
                // Stocker le fichier dans le dossier 'documents' en public
                $photo_path = $reponse_file->store('documents', 'public');
                $ticket->reponse_billet = $photo_path;
            } else {
                return redirect()->back()->with('error', 'Le fichier est invalide.');
            }
        }

        $ticket->agence_id = $request->agence_id;
        $ticket->compagnie_id = $request->compagnie_id;

        // Vérifier si le statut doit être mis à jour à "approuvé"
        // if ($request->has('status') && $request->status == 'approuvé') {
        //     // Mettre à jour le statut du ticket
        //     $ticket->status = 'approuvé';
        // }

        if ($request->filled('status')) {
            $ticket->status = $request->status;
        }


        // Enregistrer les modifications du ticket
        $ticket->save();

        return redirect()->route('reservation.show', $ticket->reservation->id)->with('success', 'Ticket mis à jour');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }


    public function download(Ticket $ticket)
    {

        // Vérifiez si l'utilisateur est autorisé à télécharger le fichier
        // $this->authorize('download-file', $file);

        // Chemin vers le fichier
        $filePath = storage_path('app/public/documents/' . $ticket->reponse_file);


        return response()->file($filePath);
    }
}
