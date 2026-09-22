<?php

namespace App\Application\Services;

use App\Domain\Interfaces\CacheInterface;

class CacheService
{
    public function __construct(
        protected CacheInterface $cache
    ) {
    }

    public function get(
        string $key,
        mixed $default = null
    ): mixed {
        return $this->cache->get($key, $default);
    }

    public function put(
        string $key,
        mixed $value,
        ?int $ttl = null
    ): bool {
        $ttl = $ttl ?? config('cache.ttl', 3600);

        return $this->cache->put(
            $key,
            $value,
            $ttl
        );
    }

    public function remember(
        string $key,
        callable $callback,
        ?int $ttl = null
    ): mixed {
        $ttl = $ttl ?? config('cache.ttl', 3600);

        return $this->cache->remember(
            $key,
            $ttl,
            $callback
        );
    }

    public function forget(string $key): bool
    {
        return $this->cache->forget($key);
    }

    public function forgetMany(array $keys): bool
    {
        return $this->cache->forgetMany($keys);
    }

    public function has(string $key): bool
    {
        return $this->cache->has($key);
    }

    public function forever(
        string $key,
        mixed $value
    ): bool {
        return $this->cache->forever(
            $key,
            $value
        );
    }

    public function flush(): bool
    {
        return $this->cache->flush();
    }
}