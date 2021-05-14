<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentaireSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentaire_size', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('alimentaire_id')->unsigned();
            $table->bigInteger('size_id')->unsigned();
            $table->double('prix');
            $table->timestamps();
            $table->foreign('alimentaire_id')->references('id')->on('alimentaires')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alimentaire_size');
    }
}
