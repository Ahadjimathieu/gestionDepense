<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Banque;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBanqueRequest;
use App\Http\Requests\UpdateBanqueRequest;

class BanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banques = Banque::all();
        return Inertia::render('Banques/Index',[
            'banques' => $banques
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBanqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "solde" => "required",

        ]);
        $banque = new Banque();
        $banque->nom = $request->nom;
        $banque->solde = $request->solde;
       


        $banque->save();
        return redirect()->route('banque.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function show(Banque $banque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function edit(Banque $banque)
    {
        
        $BanqueEdit = Banque::find($banque->id);
        return Inertia::render("Banques/Edit",[
            'banque' => $BanqueEdit,
            'banques' => Banque::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBanqueRequest  $request
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banque $banque)
    {
    
        $banque->update(
            $request->validate([
                'nom' => 'required',
                'solde' => 'required',
            ])
            );

        return redirect()->route('banque.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banque $banque)
    {
        //
    }
}
