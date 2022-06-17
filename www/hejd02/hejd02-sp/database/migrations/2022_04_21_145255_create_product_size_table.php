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
        Schema::create('product_size', function (Blueprint $table) {
            $table->id('product_size_id');
            $table->foreignId('product_id')
                ->constrained('products')
                ->references('product_id')
                ->onDelete('cascade');
            $table->foreignId('size_id')
                ->constrained('sizes')
                ->references('size_id');
            $table->string('remaining_quantity');
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
        Schema::dropIfExists('product_size');
    }
};
