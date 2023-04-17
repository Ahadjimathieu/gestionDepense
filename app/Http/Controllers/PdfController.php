<?php

namespace App\Http\Controllers;


//use Barryvdh\DomPDF\Facade\Pdf;
use PDF;
use Dompdf\Dompdf;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{

    public function getPdf(){
        $data = [];


        $pdf = new Dompdf();
        $html = 'facture';
        $pdf->loadHtml($html);

        // Génère le PDF
        $pdf->render();
        return $pdf->stream('document.pdf');

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

    public function convert_to_html()
    {


                $output='<link href="css/pdf.css" rel="stylesheet">
                <link rel="stylesheet" href="css/bootstrap.min.css"/>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                <link rel="stylesheet" href="css/font-awesome.min.css"/>


                    <div class="container-fluid" style="margin-right:0px;margin-left:0px;width:95%; padding-left:10px;  padding-top:0px;">
                        <div class="row" >
                            <div class="col-sm-12">
                                    <div class="panel panel-default invoice" id="invoice" >
                                        <div class="panel-body">
                                            <div class="invoice-ribbon"><div class="ribbon-inner">PAID</div></div>
                                                <div class="row" style="padding-top:-0px;">

                                                    <div class="col-sm-6 top-left">
                                                    <img src="images/logo.png" width="100px"/>
                                                    </div>

                                                    <div class="col-sm-6 top-right" >

                                                            <span class="marginright"></span>
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="row" style="padding-bottom:230px;">

                                                    <div class="col to" style="float:left">
                                                        <p class="lead marginbottom">Seller</p>
                                                        <p>Tramud Events & Tours </p>
                                                        <p>Suite 240, San Francisco</p>
                                                        <p>Phone:+(233)555 16 50 54</p>
                                                        <p>Email: tramudtourism@gmail.com</p>

                                                    </div>
                                                    <div class="col-xs-4 from"style="float:right">
                                                        <p class="lead marginbottom">Buyer</p>
                                                        <p class=""> Name : </p>
                                                        <p>Address:  </p>
                                                        <p></p>

                                                        <p>Phone:</p>
                                                        <p>Email: </p>

                                                    </div>


                                                </div>

                                            <div class="row table-row">
                                                <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th class="text-center" style="width:5%">Tour</th>
                                                    <th style="width:50%">Item</th>
                                                    <th class="text-right" style="width:15%">Quantity</th>
                                                    <th class="text-right" style="width:15%">Unit Price</th>
                                                    <th class="text-right" style="width:15%">Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                            <tr>
                                                                <td class="text-center"></td>
                                                                <td><img src="" width="50px"/></td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right"></td>
                                                            </tr>
                                                     </tbody>';




                                                $output.='</table>';



                                   $output.='<div class="row">

                                                <div class="col-xs-6 text-right pull-right invoice-total" style="padding-right:40px;">

                                                        <p>Total : $</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                          </div>
                    </div>';



                            return $output;


    }

}
