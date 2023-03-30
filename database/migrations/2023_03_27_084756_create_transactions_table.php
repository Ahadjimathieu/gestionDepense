<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->Integer('montant');
            $table->string('type');
            $table->string('operation');
            $table->unsignedBigInteger('paiement_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('set null');
            $table->unsignedBigInteger('depense_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('depense_id')->references('id')->on('depenses')->onDelete('set null');
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
        Schema::dropIfExists('transactions');
    }
}
