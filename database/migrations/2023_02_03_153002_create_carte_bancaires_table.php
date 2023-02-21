<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteBancairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_bancaires', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nom');
            $table->string('numero_carte');
            $table->integer('date_validite');
            $table->string('cryptogramme');
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
        Schema::dropIfExists('carte_bancaires');
    }
}
