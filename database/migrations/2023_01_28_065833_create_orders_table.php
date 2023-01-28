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
            $table->integer('customerid');
            $table->integer('product');
            $table->double('price')->length(20,2);
            $table->integer('status')->nullable();
            $table->string('orderid')->nullable();
            $table->string('paymentid')->nullable();
            $table->string('signature')->nullable();
            $table->double('totalpaid')->length(20,2);
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
        Schema::dropIfExists('orders');
    }
}
