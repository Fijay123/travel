<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('bank_id');
            $table->string('bank_from');
            $table->string('account_number');
            $table->string('account_name');
            $table->integer('payment_transfer');
            $table->string('images')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')
            ->references('id')
            ->on('bookings')
            ->onDelete('cascade');

            $table->foreign('bank_id')
            ->references('id')
            ->on('banks')
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
        Schema::dropIfExists('payments');
    }
}
