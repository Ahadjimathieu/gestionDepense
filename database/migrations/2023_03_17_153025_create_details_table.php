<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->Integer('qantite');
            $table->Integer('prix_unit');
            $table->Integer('total');
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
        Schema::dropIfExists('details');
    }
}
