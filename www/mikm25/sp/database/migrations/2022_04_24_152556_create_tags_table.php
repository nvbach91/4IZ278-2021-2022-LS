<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    public function up(): void
    {
        Schema::create('tags', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name', 30);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
}
