<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('meat_id');
            $table->string('title');
            $table->string('meat_sku');
            $table->string('meat_pick_unit');
            $table->string('meat_quantity');
            $table->string('meat_rate');
            $table->string('meat_amount');
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('session_id');
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
        Schema::dropIfExists('carts');
    }
}
