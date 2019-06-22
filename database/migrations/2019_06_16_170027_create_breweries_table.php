<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreweriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breweries', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('brewery')->unique();
          $table->string('breweryLong')->unique();
          $table->string('breweryAddress');
          $table->string('breweryUrl');
          $table->string('country');
          $table->string('region')->nullable();
          $table->string('regionalInformation')->nullable();
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
        Schema::dropIfExists('breweries');
    }
}
