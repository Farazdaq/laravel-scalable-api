# Caching

## Overview

The Laravel template provides a standardized caching layer for efficiently storing and retrieving frequently accessed or expensive data.

The caching layer supports:

- Redis
- Database cache
- File cache
- Cache TTL
- Cache invalidation
- Standardized cache keys
- Distributed caching
- Centralized cache access
- Environment-specific cache drivers

Application code should use the template `CacheService` instead of directly depending on Redis, database, or file caching.

---

## Architecture

```text
Application Service
        |
        v
   CacheService
        |
        v
 CacheInterface
        |
        v
   LaravelCache
        |
        v
 Laravel Cache
        |
        +-- File
        +-- Database
        +-- Redis
```
