<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Banque;
use App\Models\Caisse;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Virement;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $factures = Facture::where('etat', "non-regler")->get();;
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
            'paiements' => $paiements->load(['facture']),
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

         $request->validate([
            'type' => "required",
            'operation' => "nullable|string",
            'montant' => "required",
            'montant_facture' => "",
            'selectedFacture' => "required",
            'numero_compte' => "nullable|numeric|regex:/^[0-9]{10}$/",
            'numero_ordre' => "nullable|numeric|regex:/^[0-9]{10}$/",
            'banque' => "nullable|numeric",
        ]);

        $typeOperation = $request->type;
        $operation = $request->operation;
        $montant = $request->montant;
        $montant_facture = $request->montant_facture;
        $facture = $request->selectedFacture;
        $numero_compte = $request->numero_compte;
        $numero_ordre = $request->numero_ordre;
        $banque = $request->banque;

        $banque_solde = Banque::where('id', $banque)->first();



        $facture_courante = Facture::where('id', $facture)->first();

        $montant_restant = $facture_courante->montant_restant;


        $etat = "";
        if($typeOperation == 'caisse'){


                if($montant_facture > $montant){
                    $etat = "non-regler";

                }elseif($montant = $montant_facture){
                    $etat = "regler";

                }
                // Paiement
                    $paiement = new Paiement();
                    $paiement->note = $typeOperation;
                    $paiement->montant_paiement = $montant;
                    $paiement->etat = "en attente";
                    $paiement->facture_id = $facture;
                    $paiement->save();


                    $id = $paiement->id;

                //Facture
                     Facture::where('id', $facture)
                                ->update(['etat' => $etat,
                                            'montant_restant' => $montant_restant - $montant,
                                        ]);

                // Caisse
                     Caisse::create(['solde' => $montant,
                                    'paiement_id' => $id,
                                     'virement_id' => null,
                                     'depense_id' => null ]);


        }elseif(($typeOperation == 'banque')  && ($operation =='cheque')){

            $solde = $banque_solde->solde;

            if($montant_facture > $montant){
                $etat = "regler-partiellement";

            }elseif($montant = $montant_facture){
                $etat = "regler";

            }
            // Paiement

                $paiement = new Paiement();
                $paiement->note = $typeOperation.' '.$operation;
                $paiement->montant_paiement = $montant;
                $paiement->etat = "en attente";
                $paiement->facture_id = $facture;
                $paiement->save();


                $id = $paiement->id;

            //Facture
                 Facture::where('id', $facture)
                            ->update(['etat' => $etat,
                                        'montant_restant' => $montant_restant - $montant,
                                    ]);

                   $nouveau =  $solde + $paiement->montant_paiement;

                             DB::table('banques')
                             ->where('id', $banque)
                             ->update(['solde' => $nouveau]);


                Operation::create(['montant' => $paiement->montant_paiement,
                                    'etat' => "en cours",
                                    'type' => $operation,
                                    'numero_ordre' => $numero_ordre,
                                    'numero_compte' => null,
                                    'banque_id' => $banque,
                                    'paiement_id' => $id
                    ]);

                    Virement::create(['montant' => $paiement->montant_paiement,
                                        'banque_id' => $banque
                ]);


        }elseif(($typeOperation == 'banque') && ($operation == 'virement')){
            $solde = $banque_solde->solde;

            if($montant_facture > $montant){
                $etat = "a moitié regler";

            }elseif($montant = $montant_facture){
                $etat = "regler";

            }
            // Paiement

                $paiement = new Paiement();
                $paiement->note = $typeOperation.' '.$operation;
                $paiement->montant_paiement = $montant;
                $paiement->etat = "en attente";
                $paiement->facture_id = $facture;
                $paiement->save();


                $id = $paiement->id;

            //Facture
                 Facture::where('id', $facture)
                            ->update(['etat' => $etat,
                                        'montant_restant' => $montant_restant - $montant,
                                    ]);

                   $nouveau =  $solde + $paiement->montant_paiement;

                             DB::table('banques')
                             ->where('id', $banque)
                             ->update(['solde' => $nouveau]);


                Operation::create(['montant' => $paiement->montant_paiement,
                                    'etat' => "en cours",
                                    'type' => $operation,
                                    'numero_ordre' => null,
                                    'numero_compte' => $numero_compte,
                                    'banque_id' => $banque,
                                    'paiement_id' => $id
                    ]);

                    Virement::create(['montant' => $paiement->montant_paiement,
                                        'banque_id' => $banque
                ]);



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
