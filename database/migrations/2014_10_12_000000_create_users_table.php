<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('civilite')->default('Neutre');
            $table->rememberToken();
            $table->timestamps();
            $table->string('role')->default('client');
            $table->integer('nb_commandes')->default('0');
            $table->integer('argent_depense')->default('0');
            $table->integer('commande_en_cours')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
 