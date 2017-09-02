<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->increments('id');
            $table->char('icao', 4);
            $table->char('iata', 3)->nullable();
            $table->string('name');
            $table->string('city');
            $table->char('country', 2);
            $table->decimal('lat', 12, 9);
            $table->decimal('long', 12, 9);
            $table->unsignedSmallInteger('elevation');
            $table->string('timezone');
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
        Schema::dropIfExists('airports');
    }
}
