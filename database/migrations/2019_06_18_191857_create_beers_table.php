<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('beer');
            $table->integer('breweryID');
            $table->integer('beerStyleID');
            $table->string('iconPath')->nullable();
            $table->string('iconCredits')->nullable();
            // $table->string('beerTaste');
            $table->float('alcohol', 4, 2);
            $table->enum('fermentation', ['top', 'bottom']);
            $table->string('hops');
            $table->string('malts');
            $table->string('beerColour');
            $table->string('beerAroma');
            $table->boolean('flagCask')->default(0);
            $table->boolean('flagKeg')->default(0);
            $table->boolean('flagBottle')->default(0);
            $table->boolean('flagShow')->default(0);
            $table->boolean('flagLastCask')->default(0);
            $table->date('availableSoon')->nullable();
            $table->boolean('flagSoon')->default(0);
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
        Schema::dropIfExists('beers');
    }
}
