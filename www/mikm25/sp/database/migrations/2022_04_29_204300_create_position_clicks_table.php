<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionClicksTable extends Migration
{
    public function up(): void
    {
        Schema::create('position_clicks', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('position_id');
            $table->timestamp('created_at')->nullable();

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('position_clicks');
    }
}
