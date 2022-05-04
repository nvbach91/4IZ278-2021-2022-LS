<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('positions', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
            $table->foreignId('company_id')->nullable();
            $table->string('name');
            $table->string('slug', 400)->unique();
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->string('external_url', 400)->nullable();
            $table->longText('content');
            $table->string('workplace_address');
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->unsignedSmallInteger('min_practice_length')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('SET NULL')
                ->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
}
