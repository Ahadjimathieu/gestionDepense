<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\DetailCommande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::with('client')->latest()->paginate();
        return Inertia::render('Commandes/Index',[
            'commandes' =>  $commandes,
        ]);
    }

    public function validateCommande(Commande $commande)
    {
        $commande->validation = "validé";
        $commande->update();
        return redirect()->route('commande.index');
    }

    public function validateLivraison(Commande $commande)
    {
        $commande->livraison = "livrée";
        $commande->update();
        return redirect()->route('commande.index');
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
        // $paiements = Paiement::with('facture')->with('facture.client')->latest()->paginate(10);

        $commandes = Commande::with('client')->latest()->paginate(5);
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
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => "required",
            'commande' => "required",
            'montant' => "required",
            'details.*.longueur' => "required|numeric",
            'details.*.largeur' => "required|numeric",
            'details.*.produit' => "required",
            'details.*.total' => "required",
        ]);
        // dd($request->all());

        // dd($request->all());
        $commande = new Commande();
        $commande->numero_commande = $request->commande;
        $commande->client_id = $request->client_id;
        $commande->total = $request->montant;
        $commande->livraison = 'non-livrer';
        $commande->validation = 'en attente';
        $commande->save();
        //dd($commande);

        $commande_id = $commande->id;
        foreach($request->details as $detailData) {
            $detail = new DetailCommande();
            $detail->longueur = $detailData['longueur'];
            $detail->largeur = $detailData['largeur'];
            $detail->produit_id = $detailData['produit'];
            $detail->total = $detailData['total'];
            $detail->commande_id = $commande_id;
            $detail->save();
        }

        return redirect()->route('commande.index');
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
        $details = $details = DB::table('detail_commandes')
        ->join('commandes', 'commandes.id', '=', 'detail_commandes.commande_id')
        ->join('produits', 'produits.id', '=', 'detail_commandes.produit_id')
        ->select('produits.designation','produits.prix','detail_commandes.longueur', 'detail_commandes.largeur','detail_commandes.total')
        ->where('commandes.id', '=', $commande->id)
        ->get();

        //dd($details);
        return Inertia::render('Commandes/Edit',[
            'details' => $details
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeRequest  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
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
