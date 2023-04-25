<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
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
use App\Http\Requests\UpdatePaiementRequest;
use Mockery\Undefined;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $paiements = Paiement::where('etat', '=' ,'validé')->with('facture')->with('facture.client')->latest()->paginate(10);

        return Inertia::render('Paiements/Index', [
            'paiements' => $paiements,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factures = Facture::where('etat', 'non-regler')->get();
        $paiements = Paiement::with('facture')->with('facture.client')->latest()->paginate(10);
        $banques = Banque::all();
        $montant = [];
        foreach ($factures as $facture) {
            $montant[$facture->id] = $facture->montant;
        }
        $clients = Client::all();
        return Inertia::render('Paiements/Create', [
            'factures' => $factures->load(['client']),
            'paiements' => $paiements,
            'montants' => $montant,
            'clients' => $clients,
            'banques' => $banques,
        ]);
    }

    public function getMontant(Request $request)
    {
        $facture_id = $request->input('selectedFacture');
        $facture = Facture::where('id', $facture_id)->first();
        $montant = $facture ? $facture->montant : null;
        return response()->json(['montant' => $montant]);
    }
    //cancelPayment

    public function validatePayment(Paiement $paiement)
    {
        $paiement->etat = 'validé';

        $paiement->update();
        $id = $paiement->facture_id;

        if (Session::has('facture')) {
            $fact = Session::get('facture');
        }

        Facture::where('id', $id)->update(['etat' => $fact->etat, 'montant_restant' => $fact->montant_restant]);

        if ($paiement->note == 'banque-virement') {



            if (Session::has('banquevirement')) {
                $banque = Session::get('banquevirement');
            }
            Banque::where('id', $banque->id)->update(['solde' => $banque->solde]);


                $operation = new Operation();
            if (Session::has('operationvirement')) {
                $operation = Session::get('operationvirement');
            }
            $operation->save();


        } elseif ($paiement->note == 'banque-cheque') {

            if (Session::has('banquecheque')) {
                $banque = Session::get('banquecheque');
            }

            Banque::where('id', $banque->id)->update(['solde' => $banque->solde]);

            $operation = new Operation();
            if (Session::has('operationcheque')) {
                $operation = Session::get('operationcheque');
            }

            $operation->save();


        } else {
            // $caisse = new Caisse();
            $transaction = new Transaction();
            if (Session::has('transaction')) {
                $transaction = Session::get('transaction');
            }

            $transaction->save();


            // if (Session::has('caisse')) {
            //     $caisse = Session::get('caisse');
            // }
            // $caisse->save();
        }

        return redirect()->route('paiement.index');
    }

    public function cancelPayment(Paiement $paiement)
    {


        $paiement->delete();




        return redirect()->route('paiement.index');
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
            'type' => 'required',
            'operation' => 'nullable|string',
            'montant' => 'required',
            'montant_facture' => '',
            'selectedFacture' => 'required',
            'numero_compte' => "nullable|numeric|regex:/^[0-9]{10}$/",
            'numero_ordre' => "nullable|numeric|regex:/^[0-9]{10}$/",
            'banque' => 'nullable|numeric',
        ]);

        $typeOperation = $request->type;
        $operation = $request->operation;
        $montant = $request->montant;
        $montant_facture = $request->montant_facture;
        $facture = $request->selectedFacture;
        $numero_compte = $request->numero_compte;
        $numero_ordre = $request->numero_ordre;
        $banque = $request->banque;

        if($facture == ""){
            return redirect()->route('paiement.create');
        }

        $banque_solde = Banque::where('id', $banque)->first();

        $facture_courante = Facture::where('id', $facture)->first();



        $montant_restant = $facture_courante->montant_restant;

        $etat = '';
        if ($typeOperation == 'caisse') {
            if ($montant_facture > $montant) {
                $etat = 'non-regler';
            } elseif ($montant = $montant_facture) {
                $etat = 'regler';
            }
            //dd($etat);
            // Paiement
            $paiement = new Paiement();
            $paiement->note = $typeOperation;
            $paiement->montant_paiement = $montant;
            $paiement->etat = 'en attente';
            $paiement->facture_id = $facture;
            $paiement->save();

            $id = $paiement->id;

            $lafacture = new Facture();
            $lafacture->etat = $etat;
            $lafacture->id = $facture;
            $lafacture->montant_restant = $montant_restant - $montant;
            session()->put('facture', $lafacture);

            $transaction = new Transaction();
            $transaction->montant = $montant;
            $transaction->type = "paiement";
            $transaction->operation = "credit";
            $transaction->depense_id = null;
            $transaction->paiement_id = $id;
             session()->put('transaction', $transaction);
            // $caisse = new Caisse();
            // $caisse->solde = $montant;
            // $caisse->paiement_id = $id;
            // $caisse->virement_id = null;
            // $caisse->depense_id = null;

        } elseif ($typeOperation == 'banque' && $operation == 'cheque') {
            $solde = $banque_solde->solde;

            if ($montant_facture > $montant) {
                $etat = 'regler-partiellement';
            } elseif ($montant = $montant_facture) {
                $etat = 'regler';
            }
            // Paiement

            $paiement = new Paiement();
            $paiement->note = $typeOperation . '-' . $operation;
            $paiement->montant_paiement = $montant;
            $paiement->etat = 'en attente';
            $paiement->facture_id = $facture;
            $paiement->save();

            $id = $paiement->id;

            //Facture

           $lafacture = new Facture();
            $lafacture->etat = $etat;
            $lafacture->id = $facture;
            $lafacture->montant_restant = $montant_restant - $montant;
            session()->put('facture', $lafacture);

            $nouveau = $solde + $paiement->montant_paiement;

            $banquecheque = new Banque();
            $banquecheque->solde = $nouveau;
            $banquecheque->id = $banque;

            session()->put('banquecheque', $banquecheque);
            // Operation
            $operationcheque = new Operation();
            $operationcheque->etat = 'en cours';
            $operationcheque->type = $operation;
            $operationcheque->numero_ordre = $numero_ordre;
            $operationcheque->numero_compte = null;
            $operationcheque->banque_id = $banque;
            $operationcheque->montant = $paiement->montant_paiement;
            $operationcheque->paiement_id = $id;
            $operationcheque->depense_id = null;
            session()->put('operationcheque', $operationcheque);

            //Virement

            // $virementcheque = new Virement();
            // $virementcheque->montant = $paiement->montant_paiement;
            // $virementcheque->banque_id = $banque;

            // session()->put('virementcheque', $virementcheque);
        } elseif ($typeOperation == 'banque' && $operation == 'virement') {
            $solde = $banque_solde->solde;

            if ($montant_facture > $montant) {
                $etat = 'a moitié regler';
            } elseif ($montant = $montant_facture) {
                $etat = 'regler';
            }
            // Paiement

            $paiement = new Paiement();
            $paiement->note = $typeOperation . '-' . $operation;
            $paiement->montant_paiement = $montant;
            $paiement->etat = 'en attente';
            $paiement->facture_id = $facture;
            $paiement->save();

            $id = $paiement->id;

            $lafacture = new Facture();
            $lafacture->etat = $etat;
            $lafacture->id = $facture;
            $lafacture->montant_restant = $montant_restant - $montant;
            session()->put('facture', $lafacture);

            $nouveau = $solde + $paiement->montant_paiement;

            $banquevirement = new Banque();
            $banquevirement->solde = $nouveau;
            $banquevirement->id = $banque;

            session()->put('banquevirement', $banquevirement);
            // Operation
            $operationvirement = new Operation();
            $operationvirement->etat = 'en cours';
            $operationvirement->type = $operation;
            $operationvirement->montant = $paiement->montant_paiement;
            $operationvirement->numero_ordre = null;
            $operationvirement->numero_compte = $numero_compte;
            $operationvirement->banque_id = $banque;
            $operationvirement->paiement_id = $id;
            $operationvirement->depense_id = null;
            session()->put('operationvirement', $operationvirement);

            //Virement

            // $virementbancaire = new Virement();
            // $virementbancaire->montant = $paiement->montant_paiement;
            // $virementbancaire->banque_id = $banque;

            //session()->put('virementbancaire', $virementbancaire);
        }

        $request = [];
        return redirect()->route('paiement.index');

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
