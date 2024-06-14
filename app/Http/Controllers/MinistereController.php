<?php

namespace App\Http\Controllers;

use App\Models\Ministere;
use Illuminate\Http\Request;

class MinistereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ministeres = Ministere::all();
        return view("pages.ministere.ministere",compact("ministeres"));
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
        $ministere = $request->validate(
            [
                'nom' => ['required'],
                'dotation_disponible' => ['nullable','numeric'],
                'description' => ['nullable'],
            ]
        );

        try {
            Ministere::create($ministere);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route("ministere.index")->with("success","Ministère enregistré")
                                                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                                                ->header('Pragma', 'no-cache')
                                                ->header('Expires', '0');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ministere $ministere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ministere $ministere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ministere $ministere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ministere $ministere)
    {
        //
    }
}
