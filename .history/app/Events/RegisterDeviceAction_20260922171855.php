<?php

namespace App\Application\Actions;

use App\Domain\Models\Device;

class RegisterDeviceAction
{
    public function execute(
        int $userId,
        array $data
    ): Device {
        return Device::updateOrCreate(
            [
                'user_id' => $userId,
                'fcm_token' => $data['fcm_token'],
            ],
            [
                'platform' => $data['platform'],
                'device_id' =>
                    $data['device_id'] ?? null,
                'device_name' =>
                    $data['device_name'] ?? null,
                'is_active' => true,
                'last_used_at' => now(),
                'last_failed_at' => null,
            ]
        );
    }
}