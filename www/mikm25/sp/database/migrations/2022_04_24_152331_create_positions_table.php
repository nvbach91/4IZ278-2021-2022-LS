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
            $table->string('name');
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->string('external_url', 400)->nullable();
            $table->longText('content');
            $table->string('workplace_address');
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('company_name');
            $table->enum('company_size', [
                'bellow_10',
                '10_to_50',
                '50_to_100',
                'above_100',
            ])->nullable();
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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
}
