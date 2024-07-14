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
        $agences = Agence::all();
        return view("pages.agence.agence",compact("agences"));
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
        $agence = $request->validate(
            [
                'nom' => ['required'],
                'marge_eco' => ['required', 'numeric'],
                'marge_business' => ['required', 'numeric'],
                'marge_first' => ['required', 'numeric'],
                'telephone' => ['required'],
                'email' => ['required','email'],
                'description' => ['nullable'],
            ]
        );
        $agence['user_id'] = getLoggedUser()->id;

        try {
            Agence::create($agence);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route("agence.index")->with("success","Agence enregistré")
                                                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                                                ->header('Pragma', 'no-cache')
                                                ->header('Expires', '0');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agence $agence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agence $agence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agence $agence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agence $agence)
    {
        //
    }
}
