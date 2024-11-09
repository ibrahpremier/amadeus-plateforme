<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Ministere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $data = $request->validate([
            'dotation' => ['required', 'numeric']
        ]);

        $data['solde'] = $data['dotation'];
        $data['ministere_id'] = $request->user()->ministere_id;
        $data['annee_budgetaire'] = date('Y');


        Budget::create($data);

        Session::remove('BudjetAnuelle');

        return to_route('dashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
