<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_size_order', function (Blueprint $table) {
            $table->id('product_size_order_id');
            $table->foreignId('order_id')
                ->constrained('orders')
                ->references('order_id')
                ->onDelete('cascade');
            $table->foreignId('product_size_id')
                ->constrained('product_size')
                ->references('product_size_id')
                ->onDelete('cascade');
            $table->integer('product_quantity');
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
        Schema::dropIfExists('product_size_order');
    }
};
