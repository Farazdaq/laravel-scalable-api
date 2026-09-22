<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Interfaces\EmailRepositoryInterface;
use App\Domain\Models\Email;

class EmailRepository implements EmailRepositoryInterface
{
    public function create(array $data): Email
    {
        return Email::create($data);
    }

    public function find(int $id): ?Email
    {
        return Email::find($id);
    }

    public function markQueued(Email $email): Email
    {
        $email->update([
            'status' => 'queued',
            'queued_at' => now(),
        ]);

        return $email->fresh();
    }

    public function markSending(Email $email): Email
    {
        $email->update([
            'status' => 'sending',
            'attempts' => $email->attempts + 1,
        ]);

        return $email->fresh();
    }

    public function markSent(Email $email): Email
    {
        $email->update([
            'status' => 'sent',
            'sent_at' => now(),
            'error_message' => null,
        ]);

        return $email->fresh();
    }

    public function markFailed(
        Email $email,
        string $error
    ): Email {
        $email->update([
            'status' => 'failed',
            'failed_at' => now(),
            'error_message' => $error,
        ]);

        return $email->fresh();
    }
}