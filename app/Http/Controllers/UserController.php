<?php

namespace App\Http\Controllers;

use App\Models\Ministere;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
    * Handle an authentication attempt.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function login(Request $request): RedirectResponse
   {
       $credentials = $request->validate([
           'email' => ['required'],
           'password' => ['required'],
       ]);

       if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'active' => 1])) {

            SaveLog("Connexion de ".getLoggedUser()->nom." ".getLoggedUser()->prenom,getLoggedUser()->id);
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success','Connecté')
                                            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                                            ->header('Pragma', 'no-cache')
                                            ->header('Expires', '0');
        }

        SaveLog("tentative echouée de connexion de ".$credentials['email']." avec Pass: ".$credentials['password']);
       return redirect()->back()->withErrors([
            'password' => 'Les détails de connexions ne sont pas valides',
       ])->onlyInput('email');

   }


//    function register(Request $request)
//    {
//        $valides = $request->validate([
//             'nom' => 'required',
//             'prenom' => 'required',
//             'phone' => 'required|unique:users,phone,id',
//             'email' => 'required|unique:users,email,id|confirmed',
//             'password' => 'required|min:6|confirmed',
//         ]);

//            $user = User::create([
//             'nom' => strtolower($valides['nom']),
//             'prenom' =>strtolower($valides['prenom']),
//             'phone' => $$valides['phone'],
//             'email' => strtolower($valides['email']),
//             'role' => $valides['password'],
//             'poste' => $valides['password'],
//             'password' => Hash::make($valides['password']),
//           ]);


//           return redirect()->intended('/')->with('success','Votre compte à été créé');


//    }


   function disconnect(Request $request)
   {
       SaveLog("Déconnexion de ".getLoggedUser()->nom." ".getLoggedUser()->prenom,getLoggedUser()->id);
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('login')->with('success','Vous avez été déconnecté');
   }

   public function registerForm(Request $request)
   {
        return view("auth.register");
   }

   public function loginForm(Request $request)
   {
        return view("auth.login");
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("pages.user.user",compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ministeres = Ministere::all();
       return view("pages.user.user-form",compact("ministeres"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "telephone" => "required|numeric|digits:8",
            "email" => "required|email|unique:users,email,id",
            "poste" => "required",
            "civilite" => "required",
        ]);

        try {
        $user = User::create([
            "nom" => strtolower($request->nom),
            "prenom" => strtolower($request->prenom),
            "email" => strtolower($request->email),
            "telephone" => strtolower($request->telephone),
            "poste" => strtolower($request->poste),
            "role" => 'agent_ministere',
            "ministere_id" => $request->ministere,
            "created_by" => getLoggedUser()->id
        ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        $code = 12345;
        // $user->notify(new UserCreatedNotification($code,$user)); //Work
        return redirect()->route("user.index")->with("success","Utilisateur enregistré")
                                                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                                                ->header('Pragma', 'no-cache')
                                                ->header('Expires', '0');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(getLoggedUser()->id != $user->id && Auth::user()->role != "chef_cellule"){
            return redirect()->route("user.index")->with("error","Accès refusé");
        }
        return view("pages.user.user-profil",compact("user"));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
