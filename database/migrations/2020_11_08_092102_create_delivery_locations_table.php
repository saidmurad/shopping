<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_locations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->unique();
            $table->unsignedBigInteger('order_id')->unsignedBigInteger();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('phoneNumber');
            $table->string('address');
            $table->string('addressDetail');
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
        Schema::dropIfExists('delivery_locations');
    }
}
