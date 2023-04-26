<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $currentYear = date('Y');
        $approCaisseTransaction = DB::table('transactions')
            ->where('type', 'appro-caisse')
            ->whereYear('created_at', $currentYear)
            ->first();
            $salaire = DB::table('depenses')
            ->where('type', 'salaire')
            ->sum('montant');
            $prestataire = DB::table('depenses')
            ->where('type', 'prestataire')
            ->sum('montant');
            $autre = DB::table('depenses')
            ->where('type', 'autre')
            ->sum('montant');
            $depense = DB::table('depenses')
            ->sum('montant');
        $credits = Transaction::where('operation', 'credit')->sum('montant');
        $debits = Transaction::where('operation', 'debit')->sum('montant');


        $soldeCaisse = $credits - $debits;
        $user = Auth::user();
      
        return Inertia::render('Dashboard',[
            'user'=> $user,
            'soldeCaisse' => $soldeCaisse,
            'approCaisse' => $approCaisseTransaction,
            'salaire' => $salaire,
            'prestataire' => $prestataire,
            'autre' => $autre,
            'depense' => $depense,
            
        ]);
    }

        public function logout()
        {
            auth()->logout();

            return Inertia::location(route('login'));
        }
}
