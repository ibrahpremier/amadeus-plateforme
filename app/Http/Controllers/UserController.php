<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success','Connecté')
                                            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                                            ->header('Pragma', 'no-cache')
                                            ->header('Expires', '0');
        }

       return redirect()->back()->withErrors([
            'password' => 'Les détails de connexions ne sont pas valides',
       ])->onlyInput('email');

   }


   function register(Request $request)
   {
       $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required|unique:users,phone,id',
            'email' => 'required|unique:users,email,id|confirmed',
            'password' => 'required|min:6|confirmed',
            'pcode' => 'required'
        ]);
        $pcode = Code::where('pcode',$request->input('pcode'))->where('active',1)->first();

        if($pcode){
            $rand = rand(1000,9999);
            while($this->user_code_exist($rand)!=false){
                $rand = rand(1001,9999);
             }

           $user = User::create([
            'nom' => strtolower($request->input('nom')),
            'prenom' =>strtolower($request->input('prenom')),
            'phone' => $request->input('phone'),
            'email' => strtolower($request->input('email')),
            'parrain_id' => $pcode->user_id,
            'role' => $pcode->role,
            'poste' => $pcode->poste,
            'code' => $rand,
            'password' => Hash::make($request->input('password')),
          ]);

          $pcode->active = 0;
          $pcode->save();

          return redirect()->intended('/')->with('success','Votre compte à été créé');

        }
        return redirect()->back()->withErrors(['pcode' => 'Code de code invalide']);


   }


   function disconnect(Request $request)
   {
       SaveLog("Déconnexion de ".Auth::user()->prenom,Auth::user()->id);
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/')->with('success','Vous avez été déconnecté');
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
