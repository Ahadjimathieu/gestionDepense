<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->Integer('montant');
            $table->string('type');
            $table->string('operation');
            $table->unsignedBigInteger('salaire_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('salaire_id')->references('id')->on('salaires')->onDelete('set null');
            $table->unsignedBigInteger('prestataire_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('prestataire_id')->references('id')->on('prestataires')->onDelete('set null');
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
        Schema::dropIfExists('depenses');
    }
}
