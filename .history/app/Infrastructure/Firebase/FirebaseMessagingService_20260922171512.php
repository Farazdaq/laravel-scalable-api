<?php

namespace App\Infrastructure\Firebase;

class FirebaseMessagingService
{
    public function sendToToken(
        string $token,
        string $title,
        string $body,
        array $data = []
    ): void {
        // Firebase Admin SDK implementation.
    }
}