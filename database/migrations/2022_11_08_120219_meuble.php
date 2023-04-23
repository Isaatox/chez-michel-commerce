<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Meuble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meubles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('categorie');
            $table->string('couleur');
            $table->longText('description');
            $table->string('stock');
            $table->timestamps();
            $table->float('prix', 6, 2);
            $table->float('note', 1, 1)->default('0');
            $table->string('photo1');
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meuble');
    }
}
