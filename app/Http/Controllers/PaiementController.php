<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Banque;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::all();
        $paiements = Paiement::all();
        $banques = Banque::all();
        $montant = [];
        foreach ($factures as $facture) {
            $montant[$facture->id] = $facture->montant;
        }
        $clients = Client::all();
         return Inertia::render('Paiements/Index',[
            'factures' => $factures->load(['client']),
            'clients' => $clients,
            'paiements' => $paiements->load(['facture','client']),
            'montants' => $montant,
            'banques' => $banques,
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

    public function getMontant(Request $request)
    {
        $facture_id = $request->input('selectedFacture');
        $facture = Facture::where('id', $facture_id)->first();
        $montant = $facture ? $facture->montant : null;
        return response()->json(['montant' => $montant]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaiementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeOperation = $request->type;
        $operation = $request->operation;
         $request->validate([
            'montant' => "required|regex:/^\d{10}$/",
            'montant_facture' => "",
            'selectedFacture' => "required",
        ]);

        $montant = $request->montant;
        $montant_facture = $request->montant_facture;
        $facture = $request->selectedFacture;
        if($typeOperation == 'caisse'){

            $request->validate([
                'montant' => "required|regex:/^\d{10}$/",
                'montant_facture' => "",
                'selectedFacture' => "required",
            ]);
            
                $paiement = new Paiement();


        }elseif(($typeOperation == 'banque')  && ($operation =='cheque')){

            dd("C'est la banque et le cheque");
            $paiement = new Paiement();


        }elseif(($typeOperation == 'banque') && ($operation == 'virement')){
            dd("C'est la banque et le virement");
            $paiement = new Paiement();

        }



        //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show(Paiement $paiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function edit(Paiement $paiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaiementRequest  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paiement $paiement)
    {
        //
    }
}
