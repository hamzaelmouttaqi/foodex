<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat_produit', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('achats_id')->unsigned();
            $table->bigInteger('produits_id')->unsigned();
            $table->integer('quantite');
            $table->decimal('prix', 8, 2)->nullable();
            $table->foreign('achats_id')->references('id')->on('achats')->onDelete('cascade');
            $table->foreign('produits_id')->references('produit_id')->on('fournisseur_produit')->onDelete('cascade');
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
        Schema::dropIfExists('achat_produit');
    }
}
