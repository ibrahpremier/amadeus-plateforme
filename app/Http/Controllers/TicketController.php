<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Notifications\ReceiveResponseTicketNotification;
use Illuminate\Support\Facades\Auth;

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
            'reponse_date_retour' => $request->has('retour') ? 'required|date' : 'nullable|date',
            'reponse_ville_depart' => 'required|string',
            'reponse_ville_destination' => 'required|string',
            'reponse_file' => 'required|file|mimes:jpeg,png,pdf|max:5120',
            'commentaire' => 'nullable|string',
            'prix' => 'required|string',
            'status' => 'required|string|in:nouveau,affecté,traité,en cours,non disponible,approuvé,refusé,annulé,terminé',
            'reservation_id' => 'required|exists:reservations,id',
            'charge_de_mission_id' => 'required',
            'parent_ticket_id' => 'nullable|exists:tickets,id',
            'agence_id' => 'required|exists:agences,id',
            'compagnie_id' => 'required|exists:compagnies,id',
            'classe' => 'required|string|in:economique,business,first,jet',
        ], [
            'reponse_date_depart.required' => 'La date de départ est obligatoire',
            'reponse_date_depart.date' => 'La date de départ doit être une date valide',
            'reponse_date_retour.required' => 'La date de retour est obligatoire',
            'reponse_date_retour.date' => 'La date de retour doit être une date valide',
            'reponse_ville_depart.required' => 'La ville de départ est obligatoire',
            'reponse_ville_destination.required' => 'La ville de destination est obligatoire',
            'reponse_file.required' => 'Le fichier de reservation est obligatoire',
            'reponse_file.file' => 'Le fichier de reservation doit être un fichier valide',
            'reponse_file.mimes' => 'Le fichier de reservation doit être au format jpeg, png ou pdf',
            'reponse_file.max' => 'Le fichier de reservation ne doit pas dépasser 5Mo',
            'prix.required' => 'Le prix est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'status.in' => 'Le statut doit être valide',
            'reservation_id.required' => 'L\'identifiant de la réservation est obligatoire',
            'reservation_id.exists' => 'La réservation n\'existe pas',
            'charge_de_mission_id.required' => 'L\'identifiant du chargé de mission est obligatoire',
            'parent_ticket_id.exists' => 'Le ticket parent n\'existe pas',
            'agence_id.required' => 'L\'agence est obligatoire',
            'agence_id.exists' => 'L\'agence n\'existe pas',
            'compagnie_id.required' => 'La compagnie est obligatoire',
            'compagnie_id.exists' => 'La compagnie n\'existe pas',
            'classe.required' => 'La classe est obligatoire',
            'classe.in' => 'La classe doit être valide',
        ]);

        // dd($request->all());
        // Formater les dates en français avec Carbon
        Carbon::setLocale('fr');
        // $formattedDateDepart = Carbon::parse($request->reponse_date_depart)->isoFormat('D MMMM YYYY');
        // $formattedDateRetour = Carbon::parse($request->reponse_date_retour)->isoFormat('D MMMM YYYY');

        // Création du nouveau ticket
        $ticket = new Ticket();
        $ticket->reponse_date_depart = $request->reponse_date_depart;
        $ticket->reponse_date_retour = $request->reponse_date_retour;
        $ticket->reponse_ville_depart = $request->reponse_ville_depart;
        $ticket->reponse_ville_destination = $request->reponse_ville_destination;
        $ticket->response_commentaire = $request->commentaire;
        $ticket->classe = $request->classe;
        $ticket->prix = $request->prix;
        $ticket->status = $request->status;
        $ticket->reservation_id = $request->reservation_id;
        $ticket->parent_ticket_id = $request->parent_ticket_id;
        $ticket->agence_id = $request->agence_id;
        $ticket->compagnie_id = $request->compagnie_id;
        $ticket->agent_cellule_id = getLoggedUser()->id; // Assurez-vous que cette fonction existe

        if ($request->filled('prix')) {
            $ticket->reservation->montant_reservation = $request->prix;
            $ticket->reservation->agence_id = $request->agence_id;
            $ticket->reservation->compagnie_id = $request->compagnie_id;
            $ticket->reservation->classe = $request->classe;
            $ticket->reservation->ville_depart = $request->reponse_ville_depart;
            $ticket->reservation->ville_destination = $request->reponse_ville_destination;
            $ticket->reservation->date_depart = $request->reponse_date_depart;
            $ticket->reservation->date_retour = $request->reponse_date_retour;

            $ticket->reservation->status = 'traité';
            $ticket->reservation->save();
        }
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

        // Vérifiez si oldTicket est fourni et récupérez l'ancien ticket
        if ($request->filled('oldTicket')) {
            $oldTicket = Ticket::find($request->oldTicket);
            if ($oldTicket) {
                // Marquer l'ancien ticket comme traité
                $oldTicket->status = 'traité';
                $oldTicket->save();

                // Comparer les anciennes et nouvelles valeurs pour déterminer les changements
                if ($oldTicket->reponse_date_depart != $ticket->reponse_date_depart) {
                    $change['reponse_date_depart'] = [
                        'old' => $oldTicket->reponse_date_depart,
                        'new' => $ticket->reponse_date_depart,
                    ];
                }

                if ($oldTicket->reponse_date_retour != $ticket->reponse_date_retour) {
                    $change['reponse_date_retour'] = [
                        'old' => $oldTicket->reponse_date_retour,
                        'new' => $ticket->reponse_date_retour,
                    ];
                }

                if ($oldTicket->reponse_ville_depart != $ticket->reponse_ville_depart) {
                    $change['reponse_ville_depart'] = [
                        'old' => $oldTicket->reponse_ville_depart,
                        'new' => $ticket->reponse_ville_depart,
                    ];
                }

                if ($oldTicket->reponse_ville_destination != $ticket->reponse_ville_destination) {
                    $change['reponse_ville_destination'] = [
                        'old' => $oldTicket->reponse_ville_destination,
                        'new' => $ticket->reponse_ville_destination,
                    ];
                }
            }
        }
        // dd($change);

        // Enregistrement du nouveau ticket
        $ticket->save();
        // $user = Auth::user(); // Obtenir l'utilisateur connecté
        // $user->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Notification à l'agent associé à la réservation
        $ticket->reservation->agent_ministere->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Redirection avec succès et les changements
        return redirect()->route('reservation.show', $ticket->reservation_id)
            ->with('success', 'Nouveau ticket créé'); // Passer les changements si nécessaire
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
        // Initialiser le tableau des changements
        $change = [];

        // Validation du fichier si nécessaire
        $request->validate([
            // 'reponse_billet' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|string|in:nouveau,affecté,traité,en cours,non disponible,approuvé,refusé,annulé,terminé',
            // 'agence_id' => 'sometimes|required|exists:agences,id',
            // 'compagnie_id' => 'sometimes|required|exists:compagnies,id',
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


        // $ticket->agence_id = $request->agence_id;
        // $ticket->compagnie_id = $request->compagnie_id;

        // Vérifier si le statut doit être mis à jour
        if ($request->has('status')) {
            $ticket->status = $request->status;
            $ticket->reservation->status = $request->status;
        }
        $ticket->reservation->save();

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


    public function download(int $id)
    {
        $ticket = Ticket::findOrFail($id);
        if (!$ticket->reponse_file) {
            return redirect()->back()->with('error', 'Aucun fichier n\'est associé à ce ticket.');
        }

        $filePath = storage_path('app/public/' . $ticket->reponse_file);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
        }

        return response()->download($filePath);
    }


    public function downloadBillet(int $id)
    {
        $ticket = Ticket::findOrFail($id);
        if (!$ticket->reponse_billet) {
            return redirect()->back()->with('error', 'Aucun fichier n\'est associé à ce ticket.');
        }

        $filePath = storage_path('app/public/' . $ticket->reponse_billet);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
        }

        return response()->download($filePath);
    }
}
