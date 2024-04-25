<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

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
        //
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
        
        $request->validate([
            'reponse_date_depart' => 'required|date',
            'reponse_date_retour' => 'required|date',
            'reponse_ville_depart' => 'required|string',
            'reponse_ville_destination' => 'required|string',
            'reponse_file' => 'nullable|file|mimes:jpeg,png,pdf|max:5120',
            'commentaire' => 'nullable|string'
        ]);

        $ticket->reponse_ville_depart = $request->ville_depart;
        $ticket->reponse_ville_destination = $request->ville_destination;
        $ticket->reponse_date_depart = $request->date_depart;
        $ticket->reponse_date_retour = $request->date_retour;
        
        if ($request->has('commentaire')) {
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


        $ticket->save();

        return redirect()->route('reservation.show',$ticket->reservation->id)->with('success', 'Ticket mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
