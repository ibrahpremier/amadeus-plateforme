<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Dashboard;
use App\Models\Ministere;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ministeres = Ministere::all();
        $annee = date("Y");
        foreach ($ministeres as $ministere) {
            $budget = Budget::where("ministere_id",$ministere->id)->where("annee_budgetaire",$annee)->first();
            $ministere->budget = $budget->dotation;
            $ministere->solde = $budget->solde;
            $ministere->reservations_traites = Reservation::where("status","terminé")
            ->whereHas('agent_ministere' , function($query) use ($ministere){
                $query->where('ministere_id', $ministere->id);
            })
            ->count();
            $ministere->reservations_news = Reservation::where("status","nouveau")
            ->whereHas('agent_ministere' , function($query) use ($ministere){
                $query->where('ministere_id', $ministere->id);
            })
            ->count();
        }
        return view("pages.dashboard",compact("ministeres"));
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
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
