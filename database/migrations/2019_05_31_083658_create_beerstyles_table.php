<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeerstylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beerStyles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('beerStyle')->unique();
            $table->string('beerColor');
            $table->string('malts');
            $table->string('hops');
            $table->string('bitterness');
            $table->string('ibu')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beerStyles');
    }
}
