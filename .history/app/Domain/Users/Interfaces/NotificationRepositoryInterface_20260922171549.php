<?php

namespace App\Domain\Interfaces;

use App\Domain\Models\NotificationLog;

interface NotificationRepositoryInterface
{
    public function create(
        array $data
    ): NotificationLog;

    public function find(
        int $id
    ): ?NotificationLog;

    public function markQueued(
        NotificationLog $notification
    ): NotificationLog;

    public function markSending(
        NotificationLog $notification
    ): NotificationLog;

    public function markSent(
        NotificationLog $notification
    ): NotificationLog;

    public function markFailed(
        NotificationLog $notification,
        string $error
    ): NotificationLog;

    public function markRead(
        NotificationLog $notification
    ): NotificationLog;
}