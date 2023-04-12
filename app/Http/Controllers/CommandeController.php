<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;

class CommandeController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentDate = Carbon::now();
        $month = $currentDate->format('Ym');
        $count = DB::table('commandes')
                    ->whereRaw('DATE_FORMAT(created_at, "%Y%m") = ?', [$month])
                    ->count();
        $nextInvoiceNumber = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $numeroCommande = $currentDate->format('Ymd').'/'.$nextInvoiceNumber;
        $commandes = Commande::all();
        return Inertia::render('Commandes/Create',[
            'commandes' =>  $commandes,
            'clients' => Client::all(),
            'produits' => Produit::all(),
            'commande' => $numeroCommande
        ]);
    }

    public function getPrix(Request $request)
    {
        $produit_id = $request->input('produit');
        $produit = Produit::where('id', $produit_id)->first();
        $prix = $produit ? $produit->prix : null;
        return response()->json(['prix' => $prix]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommandeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommandeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeRequest  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
