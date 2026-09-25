# Docker Full-Stack Playground

A learning and testing repository for building the same small application with multiple backend and frontend technologies, all following the same API contract.

The main goal is:

> **Build once → implement everywhere → plug any frontend into any backend → run everything through Docker.**

---

# 1. Project Goals

This repository is designed to learn and practice:

- Docker
- Docker Compose
- Container networking
- Multi-container applications
- Backend architecture
- API design
- Authentication
- Database integration
- Redis
- Frontend/API integration
- Environment variables
- Reverse proxies
- Service discovery
- Health checks
- API testing
- CI/CD
- Git workflows

The application itself intentionally stays simple.

---

# 2. Application Features

## Authentication

Every API implementation should support:

- Register
- Login
- Logout
- Current authenticated user

Authentication should use the same conceptual API contract across all backends.

---

# 3. Categories

Each authenticated user can:

- List categories
- Create category
- View category
- Update category
- Delete category

Example:

```http
GET    /api/categories
POST   /api/categories
GET    /api/categories/{id}
PUT    /api/categories/{id}
DELETE /api/categories/{id}
```

---

# 4. Todos

Each authenticated user can:

- List todos
- Create todo
- View todo
- Update todo
- Delete todo

Example:

```http
GET    /api/todos
POST   /api/todos
GET    /api/todos/{id}
PUT    /api/todos/{id}
DELETE /api/todos/{id}
```

---

# 5. Posts

Each authenticated user can:

- List posts
- Create post
- View post
- Update post
- Delete post

```http
GET    /api/posts
POST   /api/posts
GET    /api/posts/{id}
PUT    /api/posts/{id}
DELETE /api/posts/{id}
```

---

# 6. Comments

Users can:

- List comments for a post
- Create a comment
- Update a comment
- Delete a comment

```http
GET    /api/posts/{post}/comments
POST   /api/posts/{post}/comments

PUT    /api/comments/{id}
DELETE /api/comments/{id}
```

---

# 7. Bloom Filter & Optimization Requirements

Every API backend should integrate a Bloom Filter mechanism (e.g. using Redis / RedisBloom or an in-memory probabilistic filter) for high-performance non-existence checks:

1. **Email Uniqueness Checks**: Check email availability during user registration (`bf:users:email`) before executing database queries.
2. **Cache Penetration Protection**: Rapid lookup for resource IDs (`bf:categories:ids`, `bf:todos:ids`, `bf:posts:ids`, `bf:comments:ids`) to return `404 Not Found` immediately on non-existent IDs, skipping database and cache load.

---

# 8. Database Model

All API implementations should use approximately the same database structure.

```text
users
├── id
├── name
├── email
├── password
├── created_at
└── updated_at

categories
├── id
├── user_id
├── name
├── created_at
└── updated_at

todos
├── id
├── user_id
├── category_id
├── title
├── description
├── completed
├── created_at
└── updated_at

posts
├── id
├── user_id
├── category_id
├── title
├── body
├── created_at
└── updated_at

comments
├── id
├── user_id
├── post_id
├── body
├── created_at
└── updated_at
```

Relationships:

```text
User
 ├── has many Categories
 ├── has many Todos
 ├── has many Posts
 └── has many Comments

Category
 ├── belongs to User
 ├── has many Todos
 └── has many Posts

Todo
 ├── belongs to User
 └── belongs to Category

Post
 ├── belongs to User
 ├── belongs to Category
 └── has many Comments

Comment
 ├── belongs to User
 └── belongs to Post
```

---

# 9. API Contract

This is one of the most important parts of the project.

Every API backend must follow the same contract.

Do NOT design a different API for every framework.

For example:

```text
Laravel API
        │
        ├── same endpoints
        ├── same HTTP methods
        ├── same status codes
        ├── same request structure
        └── same response structure

Nest API
        │
        └── same contract

FastAPI
        │
        └── same contract

Go
        │
        └── same contract
```

---

# 8. Standard Response

Successful response:

```json
{
  "data": {},
  "message": "Success"
}
```

Collection:

```json
{
  "data": [],
  "meta": {
    "current_page": 1,
    "per_page": 20,
    "total": 100
  }
}
```

Error:

```json
{
  "message": "Validation failed",
  "errors": {
    "title": ["The title field is required."]
  }
}
```

The exact internal implementation can differ between languages.

The external API should remain compatible.

---

# 9. Backend Technologies

## PHP

### Laravel API

```text
backends/php/laravel-api/
```

### Laravel Livewire

```text
backends/php/laravel-livewire/
```

### Laravel Inertia Vue

```text
backends/php/laravel-inertia-vue/
```

### Laravel Inertia React

```text
backends/php/laravel-inertia-react/
```

### Laravel Inertia Svelte

```text
backends/php/laravel-inertia-svelte/
```

---

## JavaScript / TypeScript

### Node

```text
backends/node/node/
```

### NestJS

```text
backends/node/nest/
```

### AdonisJS

```text
backends/node/adonis/
```

---

## Python

### FastAPI

```text
backends/python/fastapi/
```

### Flask

```text
backends/python/flask/
```

### Django

```text
backends/python/django/
```

---

## Go

```text
backends/go/
```

---

## Rust

```text
backends/rust/
```

---

## .NET

```text
backends/dotnet/
```

Use ASP.NET Core.

---

## Java

```text
backends/java/springboot/
```

---

# 10. Frontend Technologies

## Vue

```text
frontends/vue/
```

## React

```text
frontends/react/
```

## Svelte

```text
frontends/svelte/
```

## Nuxt

```text
frontends/nuxt/
```

## Next.js

```text
frontends/next/
```

---

# 11. Recommended Repository Structure

```text
docker-fullstack-playground/
│
├── README.md
├── LICENSE
├── .gitignore
├── .editorconfig
│
├── docs/
│   ├── api/
│   │   ├── README.md
│   │   ├── authentication.md
│   │   ├── categories.md
│   │   ├── todos.md
│   │   ├── posts.md
│   │   └── comments.md
│   │
│   ├── architecture/
│   │   ├── overview.md
│   │   ├── networking.md
│   │   ├── database.md
│   │   └── bloom-filter.md
│   │
│   └── development.md
│
├── backends/
│   │
│   ├── php/
│   │   ├── laravel-api/
│   │   ├── laravel-livewire/
│   │   ├── laravel-inertia-vue/
│   │   ├── laravel-inertia-react/
│   │   └── laravel-inertia-svelte/
│   │
│   ├── node/
│   │   ├── node/
│   │   ├── nest/
│   │   └── adonis/
│   │
│   ├── python/
│   │   ├── fastapi/
│   │   ├── flask/
│   │   └── django/
│   │
│   ├── go/
│   │
│   ├── rust/
│   │
│   ├── dotnet/
│   │
│   └── java/
│       └── springboot/
│
├── frontends/
│   ├── vue/
│   ├── react/
│   ├── svelte/
│   ├── nuxt/
│   └── next/
│
├── infrastructure/
│   ├── mysql/
│   ├── postgres/
│   ├── redis/
│   └── nginx/
│
├── docker/
│   ├── compose/
│   │   ├── base.yml
│   │   ├── laravel.yml
│   │   ├── nest.yml
│   │   ├── fastapi.yml
│   │   └── ...
│   │
│   └── scripts/
│       ├── up.ps1
│       ├── down.ps1
│       └── logs.ps1
│
├── tests/
│   └── contract/
│       ├── auth/
│       ├── categories/
│       ├── todos/
│       ├── posts/
│       └── comments/
│
└── .github/
    └── workflows/
        ├── backend-tests.yml
        └── docker.yml
```

---

# 12. Important Rule: Each Technology Is Independent

Do not create one giant Laravel/Node/Python project.

Each backend should be a normal standalone project.

For example:

```text
backends/php/laravel-api/
```

should be a normal Laravel project.

Likewise:

```text
backends/node/nest/
```

should be a normal NestJS project.

And:

```text
backends/python/fastapi/
```

should be a normal FastAPI project.

This makes the repository useful as a real Docker playground.

---

# 13. Docker Structure

Each application should have its own Dockerfile.

Example:

```text
backends/php/laravel-api/
├── Dockerfile
├── compose.yml
├── composer.json
├── app/
├── routes/
└── ...
```

But avoid duplicating infrastructure unnecessarily.

Eventually the root Compose configuration can connect the selected application to shared infrastructure.

---

# 14. Infrastructure

Start with:

```text
MySQL
Redis
```

Later add:

```text
PostgreSQL
Nginx
Mailpit
MinIO
RabbitMQ
```

Do not add everything at the beginning.

The purpose is to learn progressively.

---

# 15. Docker Network

All selected services should communicate through a Docker network.

Example:

```text
                    Docker Network
                         │
        ┌────────────────┼────────────────┐
        │                │                │
        ▼                ▼                ▼
   Frontend          Backend           MySQL
        │                │                │
        │                ├───────────────►│
        │                │
        │                ▼
        │              Redis
        │
        ▼
     Browser
```

Important:

```text
Browser
   ↓
localhost
   ↓
Docker published port
```

is different from:

```text
Backend container
   ↓
mysql
   ↓
MySQL container
```

Inside Docker, services should communicate using service names.

Example:

```env
DB_HOST=mysql
REDIS_HOST=redis
```

Not:

```env
DB_HOST=localhost
```

---

# 16. Frontend API Configuration

Every frontend must support an API base URL.

Vue:

```env
VITE_API_URL=http://localhost:8000
```

React:

```env
VITE_API_URL=http://localhost:8000
```

Svelte:

```env
VITE_API_URL=http://localhost:8000
```

Next:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000
```

Nuxt:

```env
NUXT_PUBLIC_API_URL=http://localhost:8000
```

The frontend must never hard-code a backend implementation.

---

# 17. Backend Switching

The objective is to be able to run:

```text
Vue
 +
Laravel
```

then:

```text
Vue
 +
Nest
```

then:

```text
React
 +
FastAPI
```

without modifying the frontend application code.

Only the API URL/configuration should change.

---

# 18. Example Combinations

Initial combinations:

```text
Vue       + Laravel
React     + Laravel
Svelte    + Laravel

Vue       + Nest
React     + Nest
Svelte    + Nest

Vue       + FastAPI
React     + FastAPI
Svelte    + FastAPI

Vue       + Go
React     + Go
Svelte    + Go
```

Eventually any frontend should work with any API-compatible backend.

---

# 19. Contract Tests

Create one shared contract test suite.

```text
tests/
└── contract/
    ├── auth/
    ├── categories/
    ├── todos/
    ├── posts/
    └── comments/
```

The purpose is to verify:

```text
Laravel ──┐
Nest ─────┤
FastAPI ──┤
Django ───┤
Go ───────┤──► Same contract tests
.NET ─────┤
Rust ─────┤
Spring ───┘
```

Every backend should eventually pass the same tests.

---

# 20. Development Phases

## Phase 1 — Repository

Create:

```text
README.md
docs/
backends/
frontends/
infrastructure/
docker/
tests/
```

Set up:

- Git
- `.gitignore`
- `.editorconfig`
- README

---

# Phase 2 — Laravel API

Implement:

```text
Laravel
+
MySQL
+
Redis
+
Docker
```

Implement:

- Authentication
- Categories
- Todos
- Posts
- Comments
- Bloom Filter

Then write contract tests.

---

# Phase 3 — Vue

Implement the frontend:

```text
Vue
+
Laravel API
```

Pages:

```text
/login
/register
/todos
/posts
/posts/{id}
```

---

# Phase 4 — Second Backend

Implement:

```text
NestJS
+
MySQL
+
Redis
+
Docker
```

Make it pass the same contract tests.

---

# Phase 5 — More Backends

Add:

```text
FastAPI
Go
Django
.NET
Spring Boot
Rust
Flask
Adonis
Node
```

One at a time.

Do not start the next backend until the previous one passes the API contract.

---

# Phase 6 — More Frontends

Add:

```text
React
Svelte
Nuxt
Next
```

Each frontend must work with multiple backends.

---

# Phase 7 — Docker Compose

Create convenient commands.

Examples:

```powershell
.\docker\scripts\up.ps1 laravel vue
```

```powershell
.\docker\scripts\up.ps1 nest react
```

```powershell
.\docker\scripts\up.ps1 fastapi next
```

The script should select the required services.

---

# Phase 8 — CI

GitHub Actions should eventually:

1. Detect changed backend
2. Build Docker image
3. Start required services
4. Run migrations
5. Run tests
6. Run contract tests
7. Build frontend
8. Report failure/success

---

# 21. Git Strategy

Use one repository:

```text
docker-fullstack-playground
```

Do NOT create one GitHub repository for every framework.

The whole point is that they belong to one playground.

---

# 22. Initial Git Setup

From the repository root:

```powershell
mkdir docker-fullstack-playground
cd docker-fullstack-playground

git init
```

Create the initial structure:

```powershell
mkdir docs
mkdir backends
mkdir frontends
mkdir infrastructure
mkdir docker
mkdir tests
```

Then create:

```text
README.md
.gitignore
.editorconfig
```

---

# 23. First Commit

After creating the base structure:

```powershell
git status
```

Review the files:

```powershell
git add .
```

Then:

```powershell
git commit -m "chore: initialize project"
```

---

# 24. Create GitHub Repository

Create an empty GitHub repository:

```text
docker-fullstack-playground
```

Do not initialize it with another README if you already created one locally.

Then:

```powershell
git remote add origin https://github.com/YOUR_USERNAME/docker-fullstack-playground.git
```

Verify:

```powershell
git remote -v
```

Rename the branch:

```powershell
git branch -M main
```

Push:

```powershell
git push -u origin main
```

---

# 25. Daily Git Workflow

Before starting:

```powershell
git pull
```

Create a branch:

```powershell
git switch -c feat/laravel-api
```

Work on the feature.

Check:

```powershell
git status
```

Review changes:

```powershell
git diff
```

Stage:

```powershell
git add .
```

Commit:

```powershell
git commit -m "feat: add Laravel API"
```

Push:

```powershell
git push -u origin feat/laravel-api
```

Then create a Pull Request on GitHub.

---

# 26. Branch Naming

Use:

```text
feat/laravel-api
feat/vue-frontend
feat/nest-api
feat/fastapi-api

fix/laravel-auth
fix/vue-api-url

docs/api-contract

test/contract-tests

chore/docker-compose
chore/github-actions
```

---

# 27. Commit Naming

Use Conventional Commits.

Examples:

```text
feat: add Laravel API
feat: add todo endpoints
feat: add Vue frontend

fix: correct authentication response

test: add todo contract tests

docs: document API authentication

chore: add Docker Compose configuration

refactor: simplify API error handling
```

---

# 28. What NOT to Commit

Never commit:

```text
.env
.env.local
.env.production

node_modules/
vendor/

.phpunit.cache/

__pycache__/
.pytest_cache/

target/

bin/
obj/

.next/
.nuxt/

dist/
build/

*.log
```

Also never commit:

```text
passwords
API keys
database credentials
JWT secrets
private certificates
cloud credentials
```

---

# 29. Root .gitignore

The root `.gitignore` should cover common generated files.

Framework-specific `.gitignore` files should remain inside their individual projects when generated by their tooling.

The repository should therefore have:

```text
.gitignore

backends/php/laravel-api/.gitignore
backends/node/nest/.gitignore
backends/python/django/.gitignore
...
```

This is normal.

---

# 30. Environment Files

Commit examples:

```text
.env.example
```

Never commit real:

```text
.env
```

Example:

```env
APP_ENV=local
APP_KEY=

DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=playground
DB_USERNAME=playground
DB_PASSWORD=

REDIS_HOST=redis
REDIS_PORT=6379
```

A developer creates:

```text
.env
```

from:

```text
.env.example
```

---

# 31. Docker Secrets

Never do:

```yaml
environment:
  DB_PASSWORD: my-real-password
```

for real credentials.

For local development, use environment files.

For CI/CD, use GitHub Actions Secrets.

For production, eventually learn:

```text
Docker secrets
Azure Key Vault
AWS Secrets Manager
HashiCorp Vault
```

---

# 32. README

The root README should explain:

```text
What is this?
How does it work?
Supported backends
Supported frontends
How to run it
How to switch backends
How to run tests
How to contribute
```

Example:

```bash
git clone <repository>

cd docker-fullstack-playground

cp .env.example .env

docker compose up
```

Then document the available combinations.

---

# 33. Definition of Done

A backend is considered complete when:

- [ ] Docker image builds
- [ ] Container starts
- [ ] Database connection works
- [ ] Redis connection works
- [ ] Authentication works
- [ ] Categories work
- [ ] Todos work
- [ ] Posts work
- [ ] Comments work
- [ ] Bloom filter integration works
- [ ] Validation works
- [ ] Error format follows API contract
- [ ] HTTP status codes follow contract
- [ ] Contract tests pass
- [ ] README documentation exists

A frontend is complete when:

- [ ] Docker image builds
- [ ] Application starts
- [ ] Login works
- [ ] Categories work
- [ ] Todos work
- [ ] Posts work
- [ ] Comments work
- [ ] API URL is configurable
- [ ] It can connect to multiple compatible backends

---

# 34. Final Architecture

The final goal is:

```text
                         FRONTENDS
              ┌──────────┬──────────┬──────────┐
              │          │          │          │
             Vue       React      Svelte     Next
              │          │          │          │
              └──────────┴────┬─────┴──────────┘
                              │
                              │ HTTP API
                              ▼
                    ┌───────────────────┐
                    │   API CONTRACT    │
                    └─────────┬─────────┘
                              │
          ┌───────────────────┼───────────────────┐
          │                   │                   │
          ▼                   ▼                   ▼
      Laravel              NestJS             FastAPI
          │                   │                   │
          ├───────┐           ├───────┐           ├───────┐
          ▼       ▼           ▼       ▼           ▼       ▼
        MySQL   Redis       MySQL   Redis       MySQL   Redis

                    ...more backends...
```

The key concept is:

```text
                SAME CONTRACT
                     │
        ┌────────────┼────────────┐
        ▼            ▼            ▼
     Laravel       NestJS       FastAPI
        │            │            │
        └────────────┼────────────┘
                     │
                     ▼
              ANY FRONTEND
```

---

# 35. Ultimate Goal

The finished repository should let you answer practical questions such as:

```text
How do I Dockerize Laravel?

How do I Dockerize NestJS?

How does Docker networking work?

How does Vue communicate with a containerized API?

How does React communicate with the same API?

How does authentication differ between Laravel and FastAPI?

How does Redis integration differ between frameworks?

How do database migrations work in different ecosystems?

How do I build and test every backend consistently?

How can completely different backends implement the same API?

How can the same frontend work with all of them?

How do I run everything through Docker Compose?

How do I test the whole thing in GitHub Actions?
```

That is the real purpose of this repository.

It is not a production application.

It is a **full-stack + Docker + architecture laboratory**.
