<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agences = Agence::latest()->paginate(20);
        return view("pages.agence.agence", compact("agences"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.agence.agence-form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données avec des règles plus spécifiques
        $agence = $request->validate(
            [
                'nom' => ['required', 'string', 'max:255'],
                'marge_eco' => ['required', 'numeric', 'min:0'],
                'marge_business' => ['required', 'numeric', 'min:0'],
                'marge_first' => ['required', 'numeric', 'min:0'],
                'marge_jet' => ['required', 'numeric', 'min:0'],
                'telephone' => ['required', 'string'],
                'email' => ['required', 'email', 'max:255'],
                'description' => ['nullable', 'string', 'max:1000'],
            ]
        );

        // Ajout de l'ID de l'utilisateur connecté
        $agence['user_id'] = auth()->id();

        // try {
        // Création de l'agence dans la base de données
        Agence::create($agence);

        // Redirection avec un message de succès
        return redirect()->route("agence.index")
            ->with("success", "Agence enregistrée avec succès.")
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
        // } catch (\Throwable $th) {
        //     // Gestion des erreurs, redirection avec message d'erreur
        //     return redirect()->back()
        //         ->withErrors(['error' => 'Une erreur est survenue lors de la création de l\'agence.'])
        //         ->withInput(); // Récupère les anciennes valeurs soumises
        // }
    }


    /**
     * Display the specified resource.
     */
    public function show(Agence $agence)
    {
        $agence->load('reservations');
        $reservations = $agence
            ->reservations()
            ->whereIn('status', ['terminé', 'refusé', 'annulé'])
            ->latest()
            ->get();

        return view("pages.agence.agence-show", compact("agence", 'reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agence $agence)
    {
        return view("pages.agence.agence-edit", compact("agence"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agence $agence)
    {

        // Valider les données de la requête
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'marge_eco' => 'required|numeric|min:0',
            'marge_business' => 'required|numeric|min:0',
            'marge_first' => 'required|numeric|min:0',
            'marge_jet' => 'required|numeric|min:0',
        ]);

        // Mettre à jour l'agence avec les données validées
        $agence->update($validatedData);

        // Rediriger vers la liste des agences avec un message de succès
        return redirect()->route('agence.index')
            ->with('success', 'L\'agence a été mise à jour avec succès.')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agence $agence)
    {
        $agence->delete();

        return redirect()->route('agence.index')
            ->with('success', 'L\'agence a été supprime avec succès.')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
