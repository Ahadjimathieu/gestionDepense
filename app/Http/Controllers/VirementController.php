<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Banque;
use App\Models\Virement;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVirementRequest;
use App\Http\Requests\UpdateVirementRequest;

class VirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $virements = Virement::with('banque')->latest()->paginate(10);
        return Inertia::render('Virements/Index',[
            'virements' => $virements,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $virements = Virement::with('banque')->latest()->paginate(10);
        $banques = Banque::all();
        return Inertia::render('Virements/Create',[
            'banques' => $banques,
            'virements' => $virements,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'banque' => 'required',
            'type' => 'required',
            'montant' => 'required|numeric'
        ]);

        $montant = $request->montant;
        $type = $request->type;
        $banque = $request->banque;

        $banquesolde = Banque::where('id', $banque)->first();

        $solde = $banquesolde->solde;
        
        $credits = Transaction::where('operation', 'credit')->sum('montant');
        $debits = Transaction::where('operation', 'debit')->sum('montant');
        $soldeCaisse = $credits - $debits;

        if($type === 'depot'){

            
            if($montant > $soldeCaisse){

                // Enreistrement dans Transaction 
                return redirect()->route('virement.create');

            }else{
                dd($soldeCaisse-$montant);

            }   

            
        }elseif($type === 'retrait'){
            if($solde >= $montant){

                    //Enregistrement dans Transactions
            }else{
                
                return redirect()->route('virement.create');

            }   

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function show(Virement $virement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function edit(Virement $virement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVirementRequest  $request
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVirementRequest $request, Virement $virement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Virement $virement)
    {
        //
    }
}
