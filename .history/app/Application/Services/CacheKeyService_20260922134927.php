<?php

namespace App\Application\Services;

class CacheKeyService
{
    public function user(int $userId): string
    {
        return "user:{$userId}";
    }

    public function userProfile(int $userId): string
    {
        return "user:{$userId}:profile";
    }

    public function userPermissions(int $userId): string
    {
        return "user:{$userId}:permissions";
    }

    public function settings(string $key): string
    {
        return "settings:{$key}";
    }

    public function product(int $productId): string
    {
        return "product:{$productId}";
    }
}