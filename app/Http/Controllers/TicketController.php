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
            'status' => 'required|string|in:traité,non-traité', // Ajoutez le status requis
        ]);

        // Création du nouveau ticket
        $ticket = new Ticket();
        $ticket->reponse_ville_depart = $request->reponse_ville_depart;
        $ticket->reponse_ville_destination = $request->reponse_ville_destination;
        $ticket->reponse_date_depart = $request->reponse_date_depart;
        $ticket->reponse_date_retour = $request->reponse_date_retour;
        $ticket->status = $request->status;
        $ticket->prix = $request->prix;
        $ticket->agent_cellule_id = getLoggedUser()->id;

        if ($request->filled('commentaire')) {
            $ticket->response_commentaire = $request->commentaire;
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

        // Enregistrement du ticket
        $ticket->save();

        // Associer le ticket à une réservation et mettre à jour le statut de la réservation
        $reservation = Reservation::find($request->reservation_id); // Assurez-vous d'avoir l'ID de réservation depuis le formulaire.
        if ($reservation) {
            $reservation->status = $ticket->status;
            $reservation->save();
            $ticket->reservation()->associate($reservation);
        }

        // Préparation des changements à noter pour le log (si nécessaire)
        $change = [
            'reponse_date_depart' => [
                'old' => 'N/A',
                'new' => $request->reponse_date_depart,
            ],
            'reponse_date_retour' => [
                'old' => 'N/A',
                'new' => $request->reponse_date_retour,
            ],
            'reponse_ville_depart' => [
                'old' => 'N/A',
                'new' => $request->reponse_ville_depart,
            ],
            'reponse_ville_destination' => [
                'old' => 'N/A',
                'new' => $request->reponse_ville_destination,
            ],
        ];

        // Envoyer la notification par e-mail
        $ticket->reservation->agent_ministere->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Redirection avec succès et les changements
        return redirect()->route('reservation.show', $ticket->reservation->id)
            ->with('success', 'Nouveau ticket créé')
            ->with('changes', $change);
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
        $change = [];

        if ($request->filled('status') && $request->status == "traité") {
            $request->validate([
                'reponse_date_depart' => 'required|date',
                'reponse_date_retour' => 'required|date',
                'reponse_ville_depart' => 'required|string',
                'reponse_ville_destination' => 'required|string',
                'reponse_file' => 'nullable|file|mimes:jpeg,png,pdf|max:5120',
                'commentaire' => 'nullable|string',
                'prix' => 'nullable|string'
            ]);

            // Vérification des changements
            if ($ticket->demande_date_depart != $request->reponse_date_depart) {
                $change['reponse_date_depart'] = [
                    'old' => $ticket->demande_date_depart,
                    'new' => $request->reponse_date_depart,
                ];
            }

            if ($ticket->demande_date_retour != $request->reponse_date_retour) {
                $date = Carbon::parse($request->reponse_date_retour);
                $formattedDate = $date->isoFormat('D MMMM YYYY');
                $change['reponse_date_retour'] = [
                    'old' => $ticket->demande_date_retour,
                    'new' => $formattedDate,
                ];
            }

            if ($ticket->demande_ville_depart != $request->reponse_ville_depart) {
                $date = Carbon::parse($request->reponse_date_depart);
                $formattedDate = $date->isoFormat('D MMMM YYYY');
                $change['reponse_ville_depart'] = [
                    'old' => $ticket->demande_ville_depart,
                    'new' => $formattedDate,
                ];
            }

            if ($ticket->demande_ville_destination != $request->reponse_ville_destination) {
                $change['reponse_ville_destination'] = [
                    'old' => $ticket->demande_ville_destination,
                    'new' => $request->reponse_ville_destination,
                ];
            }

            // Mise à jour des valeurs
            $ticket->reponse_ville_depart = $request->reponse_ville_depart;
            $ticket->reponse_ville_destination = $request->reponse_ville_destination;
            $ticket->reponse_date_depart = $request->reponse_date_depart;
            $ticket->reponse_date_retour = $request->reponse_date_retour;
            $ticket->status = $request->status;
            $ticket->prix = $request->prix;
            $ticket->agent_cellule_id = getLoggedUser()->id;

            if ($request->filled('commentaire')) {
                $ticket->response_commentaire = $request->commentaire;
            }

            if ($request->hasFile('reponse_file')) {
                $reponse_file = $request->file('reponse_file');

                if ($reponse_file->isValid()) {
                    $photo_path = $reponse_file->store('documents', 'public');
                    $ticket->reponse_file = $photo_path;
                } else {
                    return redirect()->back()->with('error', 'Le fichier est invalide.');
                }
            }
        } elseif ($request->filled('status')) {
            $ticket->status = $request->status;
        }

        $ticket->save();

        // Mettre à jour la réservation
        $ticket->reservation->status = $ticket->status;
        $ticket->reservation->save();

        // Envoyer la notification par e-mail
        $ticket->reservation->agent_ministere->notify(new ReceiveResponseTicketNotification($ticket, $change));

        // Vous pouvez utiliser $change ici pour d'autres opérations, comme enregistrer dans une base de données de logs ou afficher les changements à l'utilisateur.

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
