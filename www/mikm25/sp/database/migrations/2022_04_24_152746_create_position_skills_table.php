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
            $table->foreignId('fk_position_id');
            $table->foreignId('fk_skill_id');
            $table->timestamps();

            $table->foreign('fk_position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');

            $table->foreign('fk_skill_id')
                ->references('id')
                ->on('skills')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');

            $table->unique(['fk_position_id', 'fk_skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('position_skills');
    }
}