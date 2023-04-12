<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virements', function (Blueprint $table) {
            $table->id();
            $table->Integer("montant");
            $table->string('operation');
            $table->string('etat');
            $table->unsignedBigInteger('transaction_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->unsignedBigInteger('banque_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('banque_id')->references('id')->on('banques')->onDelete('set null');
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
        Schema::dropIfExists('virements');
    }
}
