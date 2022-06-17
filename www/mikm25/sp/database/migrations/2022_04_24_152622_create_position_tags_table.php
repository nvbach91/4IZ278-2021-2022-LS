<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionTagsTable extends Migration
{
    public function up(): void
    {
        Schema::create('position_tags', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('position_id');
            $table->foreignId('tag_id');
            $table->timestamps();

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');

            $table->unique(['position_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('position_tags');
    }
}
