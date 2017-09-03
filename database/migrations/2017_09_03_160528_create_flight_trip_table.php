<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_trip', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('flight_id')->index();
            $table->unsignedInteger('trip_id')->index();
            $table->unsignedTinyInteger('index');
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
        Schema::dropIfExists('flight_trip');
    }
}
