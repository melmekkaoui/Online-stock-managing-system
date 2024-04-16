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
            $table->char('client_id')->default(0);
            $table->float('discount')->default(0);
            $table->char('merchant',190);
            $table->float('order_price');
            $table->float('payed_price');
            $table->boolean('is_payed');
            $table->char('payment_method',10);
            $table->char('tracking_number',190);
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
