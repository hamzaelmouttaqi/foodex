<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentaireComposantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentaire_composant', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('alimentaire_id')->unsigned();
            $table->bigInteger('composant_id')->unsigned();
            $table->foreign('alimentaire_id')->references('id')->on('alimentaires')->onDelete('cascade');
            $table->foreign('composant_id')->references('id')->on('composants')->onDelete('cascade');
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
        Schema::dropIfExists('alimentaire_composant');
    }
}
