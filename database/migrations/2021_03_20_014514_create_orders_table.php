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
           $table->uuid('id')->primary();
            $table->integer('order_number');
            $table->string('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('address');   
            $table->string('order_status');
            $table->integer('order_meat_items');
            $table->integer('order_meat_total_qty');
            $table->string('sub_amount');
            $table->string('delivery_charges');
            $table->string('payable_amount');
            $table->string('payment_method');
            $table->text('order_requirement');
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
