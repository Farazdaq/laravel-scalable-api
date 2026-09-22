<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('fcm_token');

            $table->string('platform');
            // ios
            // android
            // web

            $table->string('device_id')
                ->nullable();

            $table->string('device_name')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamp('last_used_at')
                ->nullable();

            $table->timestamp('last_failed_at')
                ->nullable();

            $table->timestamps();

            $table->index([
                'user_id',
                'is_active',
            ]);

            $table->unique([
                'user_id',
                'fcm_token',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};