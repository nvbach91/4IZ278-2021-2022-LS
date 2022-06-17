<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracked_works', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('project_id', 36);
            $table->char('start_id', 36)->nullable()->unique();
            $table->char('end_id', 36)->nullable()->unique();
            $table->char('user_id', 36);
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
        Schema::dropIfExists('tracked_works');
    }
};
