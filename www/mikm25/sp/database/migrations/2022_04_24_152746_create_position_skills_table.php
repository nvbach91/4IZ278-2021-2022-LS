<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionSkillsTable extends Migration
{
    public function up(): void
    {
        Schema::create('position_skills', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('position_id');
            $table->foreignId('skill_id');
            $table->timestamps();

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');

            $table->foreign('skill_id')
                ->references('id')
                ->on('skills')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');

            $table->unique(['position_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('position_skills');
    }
}
