<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->string("experation_date",999)->nullable();
            $table->string('product_designation',999);
            $table->float('product_qty')->default(1);
            $table->float('critical_qty');
            $table->float('purchase_price');
            $table->float('sell_price');
            $table->char('code1',100)->unique();
            $table->char('code2',100)->unique()->nullable();
            $table->char('code3',100)->unique()->nullable();
            $table->char('code4',100)->unique()->nullable();
            $table->char('code5',100)->unique()->nullable();
            $table->char('code6',100)->unique()->nullable();
            $table->char('code7',100)->unique()->nullable();
            $table->char('code8',100)->unique()->nullable();
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
        Schema::dropIfExists('products');
    }
}
