<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->Integer("montant_paiement");
            $table->date("date_paiement");
            $table->unsignedBigInteger('facture_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('set null');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}
