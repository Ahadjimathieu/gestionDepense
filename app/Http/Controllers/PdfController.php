<?php

namespace App\Http\Controllers;


//use Barryvdh\DomPDF\Facade\Pdf;
use PDF;
use Dompdf\Dompdf;
use Inertia\Inertia;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{

    public function getPdf(){
        $data = [];


        $pdf = new Dompdf();
        $html = View::make('facture')->render();
        $pdf->loadHtml($html);

        // Génère le PDF
        $pdf->render();
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"'
        ]);
    }

    public function imprimer(Commande $commande)
    {
        $id = $commande->client_id;
        $details = $details = DB::table('detail_commandes')
        ->join('commandes', 'commandes.id', '=', 'detail_commandes.commande_id')
        ->join('produits', 'produits.id', '=', 'detail_commandes.produit_id')
        ->join('clients', 'clients.id', '=', 'commandes.client_id')
        ->select('produits.designation','produits.prix','detail_commandes.longueur', 'detail_commandes.largeur','detail_commandes.total','commandes.total', 'clients.nom','clients.prenom','clients.telephone','clients.adresse')
        ->where('commandes.id', '=', $commande->id)
        ->get();

        $pdf = new Dompdf();
        $html = View::make('commande',compact('details'))->render();
        $pdf->loadHtml($html);

        // Génère le PDF
        $pdf->render();
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"'
        ]);
       
    }
        //$html = file_get_contents('http://127.0.0.1:8000/facture/liste');

        // Récupère les erreurs éventuelles
        // $errors = $pdf->getErrors();

        // // Vérifie si des erreurs ont été trouvées
        // if (count($errors) > 0) {
        //     // Traite les erreurs ici
        //     foreach ($errors as $error) {
        //         echo $error;
        //     }
        // } else {
        //     // Si aucune erreur n'a été trouvée, envoie le PDF en réponse
        //     return $pdf->stream('document.pdf');
        // }


        // $pdf = new Dompdf();
        // $content = '<html><body><h1>Hello World</h1></body></html>';
        // $pdf->loadHtml($content);
        // $errors = $pdf->getErrors();
        // if (count($errors) > 0) {
        //     // Handle errors
        // }

        // $pdf = new Dompdf();
        // $view = 'Factures/Facture';
        // $content = Inertia::render($view)->toResponse($data)->getContent();
        // if (! $content) {
        //     abort(404);
        // }
        // $pdf->loadHtml($content);
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->render();
        // $pdfContent = $pdf->output();
        // return response($pdfContent, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="facture.pdf"'
        // ]);

        // $pdf = new Dompdf();
        // $view = 'Factures/Facture';
        // $content = Inertia::render($view)->toResponse($data)->getContent();
        // if (! $content) {
        //     abort(404);
        // }
        // $pdf->loadHtml($content);
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->render();
        // $pdf->stream('facture.pdf', ['Attachment' => false]);

        // $pdf = new Dompdf();
        // $response = Inertia::render('Factures/Facture')->toResponse($data);
        // $pdf->loadHtml($response->getContent());
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->render();
        // $pdf->stream('facture.pdf', ['Attachment' => false]);

        // $pdf = new Dompdf();
        // $pdf->loadHtml(Inertia::render('Factures/Facture')->render());
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->render();
        // $pdf->stream('facture.pdf', ['Attachment' => false]);
        // $data = [];
        // $pdf = PDF::loadView('facture',$data);
        // return $pdf->download();
        // $pdf = App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
        //     $pdf->loadHTML($this->convert_to_html());

        //     return $pdf->download();
    

   

}