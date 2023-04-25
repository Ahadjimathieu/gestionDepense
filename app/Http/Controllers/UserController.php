<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateurs = User::paginate(5);
        return Inertia::render('Utilisateurs/Index',[
            'utilisateurs' => $utilisateurs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $utilisateurs = User::paginate(5);
        return Inertia::render('Utilisateurs/Create',[
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "email" => "required|email|unique:users,email,",
            "password" => "required|unique:users,password",
            "role" => "required",

        ]);
        $utilisateur = new User();
        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->email = $request->email;
        $utilisateur->password = bcrypt($request->password);
        $utilisateur->role = $request->role;


        $utilisateur->save();
        return redirect()->route('utilisateur.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $utilisateur)
    {
        return Inertia::render("Utilisateurs/Edit",[
            'utilisateur' => $utilisateur,
            'utilisateurs' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $utilisateur)
    {
        $utilisateur->update(
            $request->validate([
                "nom" => "required",
                "prenom" => "required",
                "email" => "required",
                "password" => "required",
                "role" => "required",
            ])
            );

        return redirect()->route('utilisateur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
