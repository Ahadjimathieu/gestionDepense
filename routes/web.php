<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\VirementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PrestataireController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware("auth");

// Agents
Route::get('/agent', [AgentController::class, 'index'])->name('agent.index')->middleware("auth");

Route::get('/agent/create', [AgentController::class, 'create'])->name('agent.create')->middleware("auth");

Route::post('/agent', [AgentController::class, 'store'])->name('agent.store')->middleware("auth");

Route::get('/agent/{agent}/edit', [AgentController::class, 'edit'])->name('agent.edit')->middleware("auth");

Route::put('/agent/{agent}', [AgentController::class, 'update'])->name('agent.update')->middleware("auth");

// Clients

Route::get('/client', [ClientController::class, 'index'])->name('client.index')->middleware("auth");

Route::get('/client/create', [ClientController::class, 'create'])->name('client.create')->middleware("auth");

Route::post('/client', [ClientController::class, 'store'])->name('client.store')->middleware("auth");

Route::get('/client/{client}/edit', [ClientController::class, 'edit'])->name('client.edit')->middleware("auth");

Route::put('/client/{client}', [ClientController::class, 'update'])->name('client.update')->middleware("auth");

// Utilisateurs

Route::get('/utilisateur', [UserController::class, 'index'])->name('utilisateur.index')->middleware("auth");

Route::get('/utilisateur/create', [UserController::class, 'create'])->name('utilisateur.create')->middleware("auth");

Route::post('/utilisateur', [UserController::class, 'store'])->name('utilisateur.store')->middleware("auth");

Route::get('/utilisateur/{utilisateur}/edit', [UserController::class, 'edit'])->name('utilisateur.edit')->middleware("auth");

Route::put('/utilisateur/{utilisateur}', [UserController::class, 'update'])->name('utilisateur.update')->middleware("auth");
// Factures

Route::get('/facture', [FactureController::class, 'index'])->name('facture.index')->middleware("auth");

Route::get('/facture/create', [FactureController::class, 'create'])->name('facture.create')->middleware("auth");

Route::post('/facture', [FactureController::class, 'store'])->name('facture.store')->middleware("auth");

Route::get('/facture/{facture}/detail-facture', [FactureController::class, 'edit'])->name('facture.edit')->middleware("auth");

Route::get('/facture/{facture}/facture-pdf', [FactureController::class, 'generatePDF'])->name('facture.pdf')->middleware("auth");

Route::post('/facture/montant', [PaiementController::class, 'getMontant'])->name('facture.montant');

Route::get('/facture/liste',  [PdfController::class, 'getPdf']);

//Route::put('/facture/{facture}', [FactureController::class, 'update'])->name('facture.update')->middleware("auth");

// Paiement de Facture


Route::get('/paiement', [PaiementController::class, 'index'])->name('paiement.index')->middleware("auth");

Route::get('/paiement/regler', [PaiementController::class, 'create'])->name('paiement.create')->middleware("auth");

Route::post('/paiement', [PaiementController::class, 'store'])->name('paiement.store')->middleware("auth");

Route::post('/paiement/{paiement}/valider-paiement', [PaiementController::class, 'validatePayment'])->name('paiement.validate')->middleware("auth");

Route::delete('/paiement/{paiement}/annuler-paiement', [PaiementController::class, 'cancelPayment'])->name('paiement.cancel')->middleware("auth");




// banques

Route::get('/banque', [BanqueController::class, 'index'])->name('banque.index')->middleware("auth");

Route::post('/banque', [BanqueController::class, 'store'])->name('banque.store')->middleware("auth");

Route::get('/banque/{banque}/edit', [BanqueController::class, 'edit'])->name('banque.edit')->middleware("auth");

Route::put('/banque/{banque}', [BanqueController::class, 'update'])->name('banque.update')->middleware("auth");

// Caisse

Route::get('/caisse', [TransactionController::class, 'caisse'])->name('caisse.index')->middleware("auth");

Route::post('/caisse', [TransactionController::class, 'initialiserCaisse'])->name('caisse.initialiser')->middleware("auth");

// Depense

Route::get('/depense', [DepenseController::class, 'index'])->name('depense.index')->middleware("auth");

Route::get('/depense/create', [DepenseController::class, 'create'])->name('depense.create')->middleware("auth");

Route::post('/depense', [DepenseController::class, 'store'])->name('depense.store')->middleware("auth");

Route::post('/depense/{depense}/valider-depense', [DepenseController::class, 'validateDepense'])->name('depense.validate')->middleware("auth");

Route::delete('/depense/{depense}/annuler-depense', [DepenseController::class, 'cancelDepense'])->name('depense.cancel')->middleware("auth");

// Prestataires

Route::get('/prestataire', [PrestataireController::class, 'index'])->name('prestataire.index')->middleware("auth");

Route::get('/prestataire/create', [PrestataireController::class, 'create'])->name('prestataire.create')->middleware("auth");

Route::post('/prestataire', [PrestataireController::class, 'store'])->name('prestataire.store')->middleware("auth");

Route::get('/prestataire/{prestataire}/edit', [PrestataireController::class, 'edit'])->name('prestataire.edit')->middleware("auth");

Route::put('/prestataire/{prestataire}', [PrestataireController::class, 'update'])->name('prestataire.update')->middleware("auth");

// Virements

Route::get('/virement', [VirementController::class, 'index'])->name('virement.index')->middleware("auth");

Route::get('/virement/create', [VirementController::class, 'create'])->name('virement.create')->middleware("auth");

Route::post('/virement', [VirementController::class, 'store'])->name('virement.store')->middleware("auth");

Route::post('/virement/{virement}/valider-virement', [VirementController::class, 'validateVirement'])->name('virement.validate')->middleware("auth");

Route::delete('/virement/{virement}/annuler-virement', [VirementController::class, 'cancelVirement'])->name('virement.cancel')->middleware("auth");

// Produits

Route::get('/produit', [ProduitController::class, 'index'])->name('produit.index')->middleware("auth");

Route::get('/produit/create', [ProduitController::class, 'create'])->name('produit.create')->middleware("auth");

Route::post('/produit', [ProduitController::class, 'store'])->name('produit.store')->middleware("auth");

Route::get('/produit/{produit}/edit', [ProduitController::class, 'edit'])->name('produit.edit')->middleware("auth");

Route::put('/produit/{produit}', [ProduitController::class, 'update'])->name('produit.update')->middleware("auth");


// Commandes

Route::get('/commande', [CommandeController::class, 'index'])->name('commande.index')->middleware("auth");

Route::get('/commande/create', [CommandeController::class, 'create'])->name('commande.create')->middleware("auth");

Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store')->middleware("auth");

Route::get('/commande/{commande}/detail-commande', [CommandeController::class, 'edit'])->name('commande.edit')->middleware("auth");

Route::post('/commande/{commande}/valider-commande', [CommandeController::class, 'validateCommande'])->name('commande.validate')->middleware("auth");

Route::post('/commande/{commande}/valider-livraison', [CommandeController::class, 'validateLivraison'])->name('commande.livraison')->middleware("auth");

Route::get('/commande/{commande}/imprimer-commande', [PdfController::class, 'imprimer'])->name('commande.imprimer')->middleware("auth");



//Route::get('/facture/{facture}/facture-pdf', [FactureController::class, 'generatePDF'])->name('facture.pdf')->middleware("auth");

Route::get('/get-price', [CommandeController::class, 'getPrix'])->name('produit.prix');
