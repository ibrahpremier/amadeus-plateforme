<?php

namespace App\Http\Controllers;

use App\Models\Compagnie;
use Illuminate\Http\Request;

class CompagnieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compagnies = Compagnie::latest()->paginate(20);
        return view("pages.compagnie.compagnies", compact("compagnies"));
    }

    public function show(Compagnie $compagnie)
    {
        return view("pages.compagnie.compagnie-show", compact("compagnie"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Compagnie::create($request->all());

        return redirect()->route('compagnie.index')->with('success', 'Compagnie créée avec succès.');
    }

    public function create()
    {
        return to_route("compagnie.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compagnie $compagnie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $compagnie->update($request->all());

        return redirect()->route('compagnie.index')->with('success', 'Compagnie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compagnie $compagnie)
    {
        $compagnie->delete();

        return redirect()->route('compagnie.index')->with('success', 'Compagnie supprimée avec succès.');
    }
}
