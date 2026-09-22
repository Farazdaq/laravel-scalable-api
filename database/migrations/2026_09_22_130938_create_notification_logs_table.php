<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type');

            $table->string('title');

            $table->text('body');

            $table->json('data')
                ->nullable();

            $table->string('status')
                ->default('pending');

            // pending
            // queued
            // sending
            // sent
            // failed

            $table->unsignedInteger('attempts')
                ->default(0);

            $table->timestamp('sent_at')
                ->nullable();

            $table->timestamp('failed_at')
                ->nullable();

            $table->text('error_message')
                ->nullable();

            $table->timestamps();

            $table->index([
                'user_id',
                'status',
            ]);

            $table->index([
                'user_id',
                'created_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'notification_logs'
        );
    }
};