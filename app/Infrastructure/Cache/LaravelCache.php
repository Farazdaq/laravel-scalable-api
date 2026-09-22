<?php

namespace App\Infrastructure\Cache;

use App\Domain\Interfaces\CacheInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

class LaravelCache implements CacheInterface
{
    protected Repository $cache;

    public function __construct()
    {
        $this->cache = Cache::store();
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
        int $ttl
    ): bool {
        return $this->cache->put(
            $key,
            $value,
            now()->addSeconds($ttl)
        );
    }

    public function remember(
        string $key,
        int $ttl,
        callable $callback
    ): mixed {
        return $this->cache->remember(
            $key,
            now()->addSeconds($ttl),
            $callback
        );
    }

    public function forget(string $key): bool
    {
        return $this->cache->forget($key);
    }

    public function has(string $key): bool
    {
        return $this->cache->has($key);
    }

    public function forever(
        string $key,
        mixed $value
    ): bool {
        return $this->cache->forever($key, $value);
    }

    public function forgetMany(array $keys): bool
    {
        foreach ($keys as $key) {
            $this->cache->forget($key);
        }

        return true;
    }

    public function flush(): bool
    {
        return $this->cache->flush();
    }
}