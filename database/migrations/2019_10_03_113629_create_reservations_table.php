<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->unsignedBigInteger('phone');
            $table->string('email');
            $table->string('city');
            $table->string('postalCode');
            $table->string('address');
            $table->unsignedSmallInteger('houseNumber');
            $table->unsignedTinyInteger('sleepingAccommodation')->nullable();
            $table->unsignedTinyInteger('adults');
            $table->unsignedTinyInteger('children')->nullable();
            $table->unsignedTinyInteger('dogs')->nullable();
            $table->date('arrival');
            $table->date('departure');
            $table->text('remarks')->nullable();
            $table->unsignedTinyInteger('powerConsumption')->nullable();
            $table->unsignedTinyInteger('visitors')->nullable();
            $table->unsignedSmallInteger('discount')->nullable();
            $table->unsignedSmallInteger('extraCosts')->nullable();

            $table->unsignedBigInteger('placeNumber_id');
            $table->timestamps();

            $table->foreign('placeNumber_id')->references('id')->on('placeNumbers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
