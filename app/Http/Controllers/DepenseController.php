<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use Inertia\Inertia;
use App\Models\Agent;
use App\Models\Banque;
use App\Models\Depense;
use App\Models\Salaire;
use App\Models\Prestataire;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $depenses = Depense::with('prestataire')->with('salaire.agent')->latest()->paginate(10);
        return Inertia::render('Depenses/Index',[
            'depenses' => $depenses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        $prestataires = Prestataire::all();
        $banques = Banque::all();
        $depenses = Depense::with('prestataire')->with('salaire.agent')->latest()->paginate(10);
        return Inertia::render('Depenses/Create',[
            'agents' => $agents,
            'prestataires' => $prestataires,
            'banques' => $banques,
            'depenses' => $depenses
        ]);
    }

    public function validateDepense(Depense $depense)
    {
        //dd($depense);

        $depense->etat = 'validé';
        //dd($depense);

        $salaire = new Salaire();
        $transaction = new Transaction();
        $operation = new Operation();
        $banque = new Banque();

        if (Session::has('transaction')) {
            $transaction = Session::get('transaction');
        }
        if (Session::has('operation')) {
            $operation = Session::get('operation');
        }
        if (Session::has('banque')) {
            $banque = Session::get('banque');
        }

        if (Session::has('salaire')) {
            $salaire = Session::get('salaire');
        }






        if($depense->type == 'prestataire')
        {


        }elseif($depense->type == 'salaire'){

            $salaire->save();
            $salaire_id = $salaire->id;
            $depense->salaire_id = $salaire_id;
        }else{

        }

        //dd($banque);
        $depense->update();

        $id = $depense->id;

        if($depense->operation == 'caisse'){


            $transaction->depense_id = $id;
            $transaction->save();
        }elseif($depense->operation == 'banque'){

            Banque::where('id', $banque->id)->update(['solde' => $banque->solde]);
            $operation->etat = "validé";
            $operation->depense_id = $id;

            $operation->save();

        }

    }


    public function cancelDepense(Depense $depense)
    {

        $depense->delete();



        return redirect()->route('depense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => "required",
            'depense' => "required",
            'montant' => "required|numeric",
            'agent' => "nullable|array",
            'prestataire' => "nullable|array",
            'banque' => "nullable|array",
            'note' => "required|string|max:255",
        ]);
       // dd($request->agent['id']);
        $type = $request->type;
        $dep = $request->depense;
        //$banque_id = $request->banque['id'];
        // $prestataire_id = $request->prestataire['id'];
        // $agent = $request->agent['id'];
        $montant = $request->montant;
        $note = $request->note;
        $credits = Transaction::where('operation', 'credit')->sum('montant');
        $debits = Transaction::where('operation', 'debit')->sum('montant');
        $soldeCaisse = $credits - $debits;

        if($type == 'caisse'){
            //Transaction

            if ($montant> $soldeCaisse){

                return redirect()->route('depense.create');

            }else{

                $transaction = new Transaction();
                $transaction->montant = $montant;
                $transaction->type = $dep;
                $transaction->operation = "debit";
                $transaction->paiement_id = null;
                session()->put('transaction', $transaction);

            }

            //Depense



        }elseif($type === 'banque'){
            //oOperation

            $operation = new Operation();
            $operation->montant = $montant;
            $operation->type = "salaire";
            $operation->etat = "en cours";
            $operation->paiement_id = null;
            $operation->numero_ordre = null;
            $operation->numero_compte = null;
            $operation->banque_id = $request->banque['id'];
            session()->put('operation', $operation);


            // Depense
            //Banque

            $banque_solde = Banque::where('id', $request->banque['id'])->first();
            $solde = $banque_solde->solde;

            if ($solde >= $montant){
                $nouveau = $solde - $montant;
                $banque  = new Banque();
                $banque->solde = $nouveau;
                $banque->id = $request->banque['id'];
                session()->put('banque', $banque);

            }else{
                return redirect()->route('depense.create');
            }



        }

        if($dep === 'salaire'){
            //Salaire

            $salaire = new Salaire();
            $salaire->montant_salaire = $montant;
            $salaire->agent_id = $request->agent['id'];
            session()->put('salaire', $salaire);

            //Depense

            $depense = new Depense();
            $depense->montant = $montant;
            $depense->note = $note;
            $depense->type = $dep;
            $depense->operation = $type;
            $depense->etat = "en cours";
            $depense->salaire_id = null;
            $depense->prestataire_id = null;
            $depense->save();
        }elseif($dep === 'prestataire'){
            //Prestataire


            $depense = new Depense();
            $depense->montant = $montant;
            $depense->note = $note;
            $depense->type = $dep;
            $depense->operation = $type;
            $depense->etat = "en cours";
            $depense->salaire_id =  null;
            $depense->prestataire_id = $request->prestataire['id'];
            $depense->save();
            //session()->put('prestataire', $prestataire);


            //Depense

        }else{
            //depense
            $depense = new Depense();
            $depense->montant = $montant;
            $depense->note = $note;
            $depense->type = $dep;
            $depense->operation = $type;
            $depense->etat = "en cours";
            $depense->salaire_id =  null;
            $depense->prestataire_id = null;
            $depense->save();

        }

        $request = [];
        return redirect()->route('depense.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepenseRequest  $request
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepenseRequest $request, Depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depense $depense)
    {
        //
    }
}
