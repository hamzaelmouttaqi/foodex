<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentaireCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentaire_commande', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('alimentaire_id')->unsigned();
            $table->bigInteger('commande_id')->unsigned();
            $table->json('composantCommande');
            $table->string('sizeAlimentaire');
            $table->decimal('prixSize',6,2);
            $table->json('supplementCommande');
            $table->decimal('prixSupplement',6,2);
            $table->decimal('prixAlimentaire');
            $table->foreign('alimentaire_id')->references('id')->on('alimentaires')->onDelete('cascade');
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
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
        Schema::dropIfExists('alimentaire_commande');
    }
}
