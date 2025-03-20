<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Ministere;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\Event\Tracer\Tracer;

class BudgetController extends Controller
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
        $request->validate([
            'annee_budgetaire' => 'required|integer',
            'dotation' => 'required|numeric',
            'ministere_id' => 'required|exists:ministeres,id',
        ]);

        $existingBudget = Budget::where('annee_budgetaire', $request->annee_budgetaire)
            ->where('ministere_id', $request->ministere_id)
            ->first();

        if ($existingBudget) {
            return redirect()->back()->withErrors(['error' => 'Un budget pour cette année existe déjà pour ce ministère.']);
        }

        $budget = Budget::create([
            'annee_budgetaire' => $request->annee_budgetaire,
            'dotation' => $request->dotation,
            'solde' => $request->dotation, // Initial solde equals dotation
            'ministere_id' => $request->ministere_id,
        ]);

        Transaction::create([
            'montant' => $request->dotation,
            'type' => 'in',
            'description' => 'Dotation initiale 2025',
            'budget_id' => $budget->id,
        ]);

        $ministere = Ministere::find($request->ministere_id);
        return redirect()->back()->with('success', 'Budget 2025 du ministère ' . $ministere->nom . ' créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        return view('pages.budget.budget-show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        return view('pages.budget.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {

        $data = $request->validate([
            'dotation' => ['required', 'numeric']
        ]);

        $data['solde'] = $data['dotation'];
        $data['ministere_id'] = $request->user()->ministere_id;
        $data['annee_budgetaire'] = date('Y');

        $budget->update($data);

        Session::remove('BudjetAnuelle');

        return to_route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
