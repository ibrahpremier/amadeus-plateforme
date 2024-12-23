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
            // Assurez-vous d'inclure la validation pour 'oldTicket' si nécessaire
        ]);

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
        $ticket->agent_cellule_id = getLoggedUser()->id; // Assurez-vous que cette fonction existe

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
        // $user = auth()->user(); // Obtenir l'utilisateur connecté
        // $user->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Notification à l'agent associé à la réservation
        // $ticket->reservation->agent_ministere->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Redirection avec succès et les changements
        return redirect()->route('reservation.show', $ticket->reservation_id)
            ->with('success', 'Nouveau ticket créé')
            ->with('changes', $change); // Passer les changements si nécessaire
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
            'reponse_billet' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'sometimes|required|string|in:nouveau,affecté,traité,en cours,non disponible,approuvé,refusé,annulé,terminé',
            'agence_id' => 'sometimes|required|exists:agences,id',
            'compagnie_id' => 'sometimes|required|exists:compagnies,id',
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

        // Vérifier si le statut doit être mis à jour
        if ($request->has('status')) {
            $ticket->status = $request->status;
            // $ticket->status = $request->status == 'approuvé' ? 'approuvé' : $request->status;
            // Logique de mise à jour du statut de la réservation
            if ($request->status == 'traitement') {
                $ticket->reservation->status = $ticket->reservation->status; // Conserver le statut actuel
            } elseif ($request->status == 'approuvé') {
                $ticket->reservation->status = 'terminé';
            } else {
                // Autres cas de statut
                $ticket->reservation->status = $request->status;
            }
        }
        $ticket->reservation->save();
        // Vérification des changements sur les dates et villes
        if ($request->filled('reponse_date_depart') && $ticket->reponse_date_depart != $request->reponse_date_depart) {
            $change['reponse_date_depart'] = [
                'old' => $ticket->reponse_date_depart,
                'new' => $request->reponse_date_depart,
            ];
            $ticket->reponse_date_depart = $request->reponse_date_depart;
        }

        if ($request->filled('reponse_date_retour') && $ticket->reponse_date_retour != $request->reponse_date_retour) {
            $change['reponse_date_retour'] = [
                'old' => $ticket->reponse_date_retour,
                'new' => $request->reponse_date_retour,
            ];
            $ticket->reponse_date_retour = $request->reponse_date_retour;
        }

        if ($request->filled('reponse_ville_depart') && $ticket->reponse_ville_depart != $request->reponse_ville_depart) {
            $change['reponse_ville_depart'] = [
                'old' => $ticket->reponse_ville_depart,
                'new' => $request->reponse_ville_depart,
            ];
            $ticket->reponse_ville_depart = $request->reponse_ville_depart;
        }

        if ($request->filled('reponse_ville_destination') && $ticket->reponse_ville_destination != $request->reponse_ville_destination) {
            $change['reponse_ville_destination'] = [
                'old' => $ticket->reponse_ville_destination,
                'new' => $request->reponse_ville_destination,
            ];
            $ticket->reponse_ville_destination = $request->reponse_ville_destination;
        }

        // Enregistrer les modifications du ticket
        // dd($change);
        $ticket->save();

        // Notification à l'utilisateur connecté
        // $user = auth()->user();
        // $user->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Notification à l'agent associé à la réservation
        // $ticket->reservation->agent_ministere->notify(new ReceiveResponseTicketNotification($ticket, $change));

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
