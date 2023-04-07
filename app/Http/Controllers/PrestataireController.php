<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Prestataire;
use Illuminate\Http\Request;


class PrestataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Prestataires/Index",[
            'prestataires' => Prestataire::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Prestataires/Create',[
            'prestataires' => Prestataire::paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrestataireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",

        ]);
        $prestataire = new Prestataire();
        $prestataire->nom = $request->nom;
        $prestataire->save();
        return redirect()->route('prestataire.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
    public function show(Prestataire $prestataire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestataire $prestataire)
    {
        $prestataireEdit = Prestataire::find($prestataire->id);
        return Inertia::render("Prestataires/Edit",[
            'prestataire' => $prestataireEdit,
            'prestataires' => Prestataire::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrestataireRequest  $request
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestataire $prestataire)
    {
        $prestataire->update(
            $request->validate([
                'nom' => 'required',
               
            ])
            );

        return redirect()->route('prestataire.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestataire $prestataire)
    {
        //
    }
}
