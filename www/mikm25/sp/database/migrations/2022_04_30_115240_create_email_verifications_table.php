<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailVerificationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('email_verifications', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('token')->unique();
            $table->foreignId('user_id');
            $table->boolean('used')->default(0);
            $table->boolean('invalidated')->default(0);
            $table->timestamp('valid_until');
            $table->timestamp('invalidated_at')->nullable();
            $table->timestamp('used_at')->nullable();
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
        Schema::dropIfExists('email_verifications');
    }
}
