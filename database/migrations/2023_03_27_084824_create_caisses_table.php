<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaissesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->integer('solde');
            $table->unsignedBigInteger('virement_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('virement_id')->references('id')->on('virements')->onDelete('set null');
            $table->unsignedBigInteger('paiement_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('set null');
            $table->foreignId('depense_id')->constrained();
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
        Schema::dropIfExists('caisses');
    }
}
