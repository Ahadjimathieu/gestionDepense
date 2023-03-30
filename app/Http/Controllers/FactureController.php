<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Detail;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::all();
        return Inertia::render('Factures/Index',[
            'factures' => $factures->load(['client'])
        ]);
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentDate = Carbon::now();
        $month = $currentDate->format('Ym');
        $count = DB::table('factures')
                    ->whereRaw('DATE_FORMAT(created_at, "%Y%m") = ?', [$month])
                    ->count();
        $nextInvoiceNumber = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $numeroFacture = $currentDate->format('Ymd').'/'.$nextInvoiceNumber;
        $factures = Facture::all();
        return Inertia::render('Factures/Create',[
            'factures' =>  $factures->load(['client']),
            'clients' => Client::all(),
            'facture' => $numeroFacture
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFactureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'client_id' => "required",
        //     'facture' => "required",
        //     'detail.designation' => "required|string|max:255",
        //     'detail.qantite' => "required|numeric",
        //     'detail.prix_unit' => "required|numeric",
        //     'detail.total' => "required",
        // ]);


        $facture = new Facture();
        $facture->numero_facture = $request->facture;
        $facture->montant = $request->montant;
        $facture->montant_restant = $request->montant;
        $facture->etat = 'non-regler';
        $facture->client_id = $request->client_id;
        $facture->save();

        $facture_id = $facture->id;

        foreach($request->details as $detailData) {
            $detail = new Detail();
            $detail->designation = $detailData['designation'];
            $detail->qantite = $detailData['quantite'];
            $detail->prix_unit = $detailData['prix_unit'];
            $detail->total = $detailData['total'];
            $detail->facture_id = $facture_id;
            $detail->save();
        }


        return redirect()->route('facture.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {



        $details = $details = DB::table('details')
                ->join('factures', 'factures.id', '=', 'details.facture_id')
                ->select('details.designation', 'details.qantite', 'details.prix_unit', 'details.total')
                ->where('factures.id', '=', $facture->id)
                ->get();

        //dd($details);
        return Inertia::render('Factures/Edit',[
            'details' => $details
        ]);
    }


    // public function generatePDF(Facture $facture)
    //     {

    //          // Récupération du contenu du fichier Vue
    //         $vueContent = Inertia::render('Factures/Facture')->content();

    //         // Création d'une instance Dompdf
    //         $dompdf = new Dompdf();

    //         // Conversion du contenu Vue en HTML
    //         $dompdf->loadHtml($vueContent);

    //         // Rendu du PDF
    //         $dompdf->render();

    //         // Envoi du PDF en tant que téléchargement
    //         return $dompdf->stream('document.pdf');
    //         // $pdfHtml = Inertia::render('Factures/Fcature')->toHtml();

    //         // // Instancier la classe Dompdf
    //         // $pdf = new Dompdf();

    //         // // Charger le contenu HTML dans Dompdf
    //         // $pdf->loadHtml($pdfHtml);

    //         // // Rendre le PDF
    //         // $pdf->render();

    //         // // Enregistrer le PDF généré dans un fichier
    //         // $pdfOutput = $pdf->output();
    //         // file_put_contents('facture.pdf', $pdfOutput);
    //     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFactureRequest  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
