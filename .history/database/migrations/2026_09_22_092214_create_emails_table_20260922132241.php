<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('recipient');
            $table->string('subject');

            $table->string('type');
            // verification
            // password_reset
            // payment
            // notification
            // generic

            $table->string('status')
                ->default('pending');
            // pending
            // queued
            // sending
            // sent
            // failed

            $table->string('provider')
                ->nullable();

            $table->unsignedInteger('attempts')
                ->default(0);

            $table->timestamp('queued_at')
                ->nullable();

            $table->timestamp('sent_at')
                ->nullable();

            $table->timestamp('failed_at')
                ->nullable();

            $table->text('error_message')
                ->nullable();

            $table->json('metadata')
                ->nullable();

            $table->timestamps();

            $table->index([
                'status',
                'created_at',
            ]);

            $table->index([
                'recipient',
            ]);

            $table->index([
                'type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};