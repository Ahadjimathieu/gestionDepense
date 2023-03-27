<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->integer('montant');
            $table->string('etat');
            $table->unsignedBigInteger('paiement_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('set null');
            $table->foreignId('banque_id')->constrained();
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
        Schema::dropIfExists('operations');
    }
}
