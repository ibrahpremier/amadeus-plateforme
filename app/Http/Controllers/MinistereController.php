<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Ministere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MinistereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ministeres = Ministere::latest()->paginate(20);
        return view("pages.ministere.ministere", compact("ministeres"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.ministere.ministere-form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $data = $request->validate([
            'nom' => ['required'],
            'dotation' => ['required', 'numeric'],
            'description' => ['nullable'],
        ]);

        // Utilisation d'une transaction pour garantir l'intégrité des données
        DB::beginTransaction();

        try {
            // Création du ministère
            $ministere = Ministere::create($data);

            // Création du budget associé
            Budget::create([
                'dotation' => $data['dotation'],
                'solde' => $data['dotation'],
                'ministere_id' => $ministere->id,
                'annee_budgetaire' => date('Y')
            ]);

            // Validation de la transaction
            DB::commit();

            // Redirection après succès
            return redirect()->route("ministere.index")
                ->with("success", "Ministère enregistré")
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Throwable $th) {
            // Annulation de la transaction en cas d'erreur
            DB::rollBack();
            return back()->withErrors("Une erreur s'est produite lors de l'enregistrement du ministère.")->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ministere $ministere)
    {
        return view("pages.ministere.ministere-edit", compact("ministere"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ministere $ministere)
    {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'nom' => ['required'],
            'dotation' => ['required', 'numeric'],
            'description' => ['nullable'],
        ]);

        // Gestion des exceptions lors de la mise à jour
        try {
            $ministere->update($validatedData);
        } catch (\Throwable $th) {
            throw $th;
        }



        // Redirection après succès
        return redirect()->route("ministere.index")
            ->with("success", "Ministère mis à jour")
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ministere $ministere)
    {
        // Gestion des exceptions lors de la suppression
        try {
            $ministere->delete();
        } catch (\Throwable $th) {
            throw $th;
        }

        // Redirection après succès
        return redirect()->route("ministere.index")
            ->with("success", "Ministère supprimé");
    }
}
