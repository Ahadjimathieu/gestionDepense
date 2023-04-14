<?php

namespace App\Http\Controllers;


use Exception;
use  PDF;

class PdfController extends Controller
{

    public function getPdf(){
        $users = [];
        $pdf = PDF::loadView('pdf.blade', $users);
        return $pdf->stream('mon-fichier-pdf.pdf');
       

       
        
    }

}
