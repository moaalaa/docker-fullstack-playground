# Bloom Filter Architecture

## Overview

A **Bloom Filter** is a space-efficient probabilistic data structure used to test whether an element is a member of a set.
- **False Positive**: Possible (it may report an element is present when it is not).
- **False Negative**: Impossible (if it reports an element is **not** present, it is **guaranteed** not to be in the set).

In this playground repository, every backend implementation uses Bloom Filters to optimize performance, prevent cache penetration, and minimize unnecessary database queries.

---

## Primary Use Cases

### 1. User Email Uniqueness Pre-Check

During user registration (`POST /api/register`), the system must verify that the requested email address is not already registered.

- **Key**: `bf:users:email`
- **Flow**:
  1. When a registration request arrives, query `BF.EXISTS bf:users:email <email>`.
  2. If `0` (not found): The email is **guaranteed** not to exist in the database. Proceed directly with password hashing and user creation without querying `SELECT ... WHERE email = ...`.
  3. If `1` (might exist): Perform a database lookup to confirm whether the email exists (handling potential false positives).
  4. Upon successful user registration, insert the email into the Bloom Filter using `BF.ADD bf:users:email <email>`.

### 2. Cache Penetration Protection for Resource IDs

When clients request resources by ID (e.g. `GET /api/categories/{id}`, `GET /api/todos/{id}`, `GET /api/posts/{id}`, `GET /api/comments/{id}`), malicious or invalid requests for non-existent IDs can bypass cache layers and strain the primary relational database (cache penetration).

- **Keys**:
  - `bf:categories:ids`
  - `bf:todos:ids`
  - `bf:posts:ids`
  - `bf:comments:ids`
- **Flow**:
  1. On resource lookup by ID, check `BF.EXISTS <filter_key> <id>`.
  2. If `0` (not found): Return `404 Not Found` immediately. Do not query Redis cache or MySQL/Postgres database.
  3. If `1` (might exist): Query Redis cache or primary database for the resource.
  4. Upon creating a new resource, insert its generated ID into the respective Bloom Filter key (`BF.ADD`).

---

## Technical Specs & Redis Integration

### RedisBloom Module

Backends using Redis can leverage the `RedisBloom` module or equivalent client driver commands:

```text
# Initialize Bloom filter (capacity: 100,000 items, false positive rate: 1%)
BF.RESERVE bf:users:email 0.01 100000

# Add element
BF.ADD bf:users:email "user@example.com"

# Check existence
BF.EXISTS bf:users:email "user@example.com"
```

### Framework / Standard Redis Fallback

For backends running on standard Redis without RedisBloom extension, backends can use:
- An in-memory Bloom Filter library synchronized with Redis Bitmaps (`SETBIT` / `GETBIT`).
- An in-memory Bloom filter data structure seeded at application boot.

---

## Initialization & Seeding Strategy

On application startup or container initialization:
1. Backends verify or create the required Bloom Filters.
2. If the filter is uninitialized, the backend seeds existing records from the database (`users.email`, `categories.id`, `todos.id`, `posts.id`, `comments.id`).
3. During normal execution, all creation events update both the database and the corresponding Bloom Filter.
