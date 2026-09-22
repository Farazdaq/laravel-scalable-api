<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Interfaces\NotificationRepositoryInterface;
use App\Domain\Models\NotificationLog;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function create(
        array $data
    ): NotificationLog {
        return NotificationLog::create(
            $data
        );
    }

    public function find(
        int $id
    ): ?NotificationLog {
        return NotificationLog::find($id);
    }

    public function markQueued(
        NotificationLog $notification
    ): NotificationLog {
        $notification->update([
            'status' => 'queued',
        ]);

        return $notification->fresh();
    }

    public function markSending(
        NotificationLog $notification
    ): NotificationLog {
        $notification->update([
            'status' => 'sending',
            'attempts' =>
                $notification->attempts + 1,
        ]);

        return $notification->fresh();
    }

    public function markSent(
        NotificationLog $notification
    ): NotificationLog {
        $notification->update([
            'status' => 'sent',
            'sent_at' => now(),
            'error_message' => null,
        ]);

        return $notification->fresh();
    }

    public function markFailed(
        NotificationLog $notification,
        string $error
    ): NotificationLog {
        $notification->update([
            'status' => 'failed',
            'failed_at' => now(),
            'error_message' => $error,
        ]);

        return $notification->fresh();
    }

    public function markRead(
        NotificationLog $notification
    ): NotificationLog {
        $notification->update([
            'read_at' => now(),
        ]);

        return $notification->fresh();
    }
}