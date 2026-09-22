<?php

namespace App\Domain\Interfaces;

interface CacheInterface
{
    public function get(string $key, mixed $default = null): mixed;

    public function put(
        string $key,
        mixed $value,
        int $ttl
    ): bool;

    public function remember(
        string $key,
        int $ttl,
        callable $callback
    ): mixed;

    public function forget(string $key): bool;

    public function has(string $key): bool;

    public function forever(
        string $key,
        mixed $value
    ): bool;

    public function forgetMany(array $keys): bool;

    public function flush(): bool;
}