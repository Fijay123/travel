<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('driver_id');
            $table->date('date_departure');
            $table->integer('seat');
            $table->integer('price');
            $table->integer('status')->default('0');
            $table->timestamps();

            $table->foreign('car_id')
            ->references('id')
            ->on('cars')
            ->onDelete('cascade');

            $table->foreign('route_id')
            ->references('id')
            ->on('routes')
            ->onDelete('cascade');

            $table->foreign('driver_id')
            ->references('id')
            ->on('drivers')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
