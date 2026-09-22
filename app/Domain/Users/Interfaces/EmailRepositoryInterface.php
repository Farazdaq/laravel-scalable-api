<?php

namespace App\Domain\Interfaces;

use App\Domain\Models\Email;

interface EmailRepositoryInterface
{
    public function create(array $data): Email;

    public function find(int $id): ?Email;

    public function markQueued(Email $email): Email;

    public function markSending(Email $email): Email;

    public function markSent(Email $email): Email;

    public function markFailed(
        Email $email,
        string $error
    ): Email;
}