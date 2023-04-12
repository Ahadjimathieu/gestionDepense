<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_commandes', function (Blueprint $table) {
            $table->id();
            $table->Integer('longueur');
            $table->Integer('largeur');
            $table->Integer('total');
            $table->unsignedBigInteger('commande_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('set null');
            $table->unsignedBigInteger('produit_id')->nullable(); // déclare la clé étrangère id_directeur comme étant nullable
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('set null');
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
        Schema::dropIfExists('detail_commandes');
    }
}
