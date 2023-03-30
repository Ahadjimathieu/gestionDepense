<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function caisse()
    {
        return Inertia::render('Caisses/Create');
    }

    public function initialiserCaisse(Request $request)
    {

        $request->validate([
            'montant' => 'required|numeric'
        ]);

        $transaction = new Transaction();
        $transaction->montant = $request->montant;
        $transaction->type = "appro-caisse";
        $transaction->operation = "credit";
        $transaction->depense_id = null;
        $transaction->paiement_id = null;

        // Obtenez la date actuelle

        // Boucle pour chaque année à partir de janvier jusqu'à l'année actuelle
        $currentYear = date('Y');
        $approCaisseTransaction = DB::table('transactions')
            ->where('type', 'appro-caisse')
            ->whereYear('created_at', $currentYear)
            ->first();

            if ($approCaisseTransaction) {

                return redirect()->back()->with("error", "L'initialisation de cette est déjà effectué");
            } else {

                $transaction->save();

                return redirect()->back()->with("success", " Initialisation effectué avec succès");

            }

            // Décrémentez l'année pour vérifier l'année précédente

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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
