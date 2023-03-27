<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PaiementController;

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

// Factures

Route::get('/facture', [FactureController::class, 'index'])->name('facture.index')->middleware("auth");

Route::get('/facture/create', [FactureController::class, 'create'])->name('facture.create')->middleware("auth");

Route::post('/facture', [FactureController::class, 'store'])->name('facture.store')->middleware("auth");

Route::get('/facture/{facture}/detail-facture', [FactureController::class, 'edit'])->name('facture.edit')->middleware("auth");

Route::get('/facture/{facture}/facture-pdf', [FactureController::class, 'generatePDF'])->name('facture.pdf')->middleware("auth");

Route::post('/facture/montant', [PaiementController::class, 'getMontant'])->name('facture.montant');

//Route::put('/facture/{facture}', [FactureController::class, 'update'])->name('facture.update')->middleware("auth");

// Paiement de Facture

Route::get('/paiement/regler', [PaiementController::class, 'index'])->name('paiement.index')->middleware("auth");

Route::get('/paiement', [PaiementController::class, 'create'])->name('paiement.create')->middleware("auth");

Route::post('/paiement', [PaiementController::class, 'store'])->name('paiement.store')->middleware("auth");



// banques

Route::get('/banque', [BanqueController::class, 'index'])->name('banque.index')->middleware("auth");

Route::post('/banque', [BanqueController::class, 'store'])->name('banque.store')->middleware("auth");

Route::get('/banque/{banque}/edit', [BanqueController::class, 'edit'])->name('banque.edit')->middleware("auth");

Route::put('/banque/{banque}', [BanqueController::class, 'update'])->name('banque.update')->middleware("auth");


