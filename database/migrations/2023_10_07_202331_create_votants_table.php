<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votants', function (Blueprint $table) {
            $table->id();
            $table->string('numero_electeur')->nullable();
            $table->string('prenom')->nullable();
            $table->string('nom')->nullable();
            $table->string('region')->nullable();
            $table->string('departement')->nullable();
            $table->string('commune')->nullable();
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
        Schema::dropIfExists('votants');
    }
};
