<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivering_address');
            $table->foreign('delivering_address')->references('id')->on('addresses');
            $table->enum('created_by', ['Pharmacy', 'Doctor', 'User']);
            $table->enum('status', ['New', 'Processing', 'WaitingForUserConfirmation', 'Canceled', 'Confirmed', 'Delivered']);
            $table->float('total_price', 10, 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('pharmacy_id')->nullable();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
