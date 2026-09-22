# Docker Full-Stack Playground

A learning and experimentation playground for building the **same application with different backend and frontend technologies**, all running through Docker.

The goal is simple:

> **Build once. Learn many stacks. Plug any compatible backend into any frontend.**

---

## What is this?

This repository contains the same small application implemented using multiple backend and frontend technologies.

The application provides:

- Authentication
- Categories
- Todos
- Posts
- Comments

The important part is that every API backend follows the **same API contract**.

That means a frontend should not care whether the API is powered by:

- Laravel
- NestJS
- FastAPI
- Django
- Go
- Rust
- .NET
- Spring Boot
- etc.

As long as the backend follows the project API contract, the frontend can use it.

---

# How does it work?

The project is divided into three main parts:

```text
                    ┌─────────────────────┐
                    │      Frontend       │
                    │                     │
                    │ Vue / React /       │
                    │ Svelte / Nuxt /     │
                    │ Next                │
                    └──────────┬──────────┘
                               │
                               │ HTTP API
                               ▼
                    ┌─────────────────────┐
                    │       Backend       │
                    │                     │
                    │ Laravel / Nest /    │
                    │ FastAPI / Go / ...  │
                    └──────────┬──────────┘
                               │
                    ┌──────────┴──────────┐
                    │                     │
                    ▼                     ▼
              ┌───────────┐         ┌───────────┐
              │   MySQL   │         │   Redis   │
              └───────────┘         └───────────┘
```

Every backend implements the same application and API behavior.

Every frontend communicates with the API through the same contract.

For example:

```text
Vue + Laravel
Vue + NestJS
Vue + FastAPI
Vue + Go

React + Laravel
React + NestJS
React + FastAPI
React + Go

Svelte + Laravel
Svelte + NestJS
Svelte + FastAPI
Svelte + Go
```

The frontend should only need its API URL changed.

---

# Project Structure

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
│   │   └── database.md
│   │
│   └── development.md
│
├── backends/
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
│   ├── rust/
│   ├── dotnet/
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

# Supported Backends

The following backend implementations are planned.

| Backend                  | Status     |
| ------------------------ | ---------- |
| Laravel API              | 🟡 Planned |
| Laravel Livewire         | ⬜ Planned |
| Laravel Inertia + Vue    | ⬜ Planned |
| Laravel Inertia + React  | ⬜ Planned |
| Laravel Inertia + Svelte | ⬜ Planned |
| Node.js                  | ⬜ Planned |
| NestJS                   | ⬜ Planned |
| AdonisJS                 | ⬜ Planned |
| FastAPI                  | ⬜ Planned |
| Flask                    | ⬜ Planned |
| Django                   | ⬜ Planned |
| Go                       | ⬜ Planned |
| Rust                     | ⬜ Planned |
| .NET                     | ⬜ Planned |
| Spring Boot              | ⬜ Planned |

### Status Legend

```text
⬜ Planned
🟡 In Progress
🟢 Completed
🔴 Blocked
```

---

# Supported Frontends

| Frontend | Status     |
| -------- | ---------- |
| Vue      | ⬜ Planned |
| React    | ⬜ Planned |
| Svelte   | ⬜ Planned |
| Nuxt     | ⬜ Planned |
| Next.js  | ⬜ Planned |

---

# Application Features

Every API backend should implement the same features.

| Feature        | Laravel | Nest | FastAPI | Django |  Go | Rust | .NET | Spring |
| -------------- | ------: | ---: | ------: | -----: | --: | ---: | ---: | -----: |
| Authentication |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |
| Categories     |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |
| Todos          |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |
| Posts          |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |
| Comments       |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |
| Validation     |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |
| Contract Tests |      ⬜ |   ⬜ |      ⬜ |     ⬜ |  ⬜ |   ⬜ |   ⬜ |     ⬜ |

---

# Database Model

The core relationship is:

```text
User
 │
 ├── Categories
 │      │
 │      ├── Todos
 │      │
 │      └── Posts
 │              │
 │              └── Comments
 │
 ├── Todos
 ├── Posts
 └── Comments
```

### Main tables

```text
users
categories
todos
posts
comments
```

Relationships:

```text
Category
 ├── hasMany Todos
 └── hasMany Posts

Todo
 ├── belongsTo User
 └── belongsTo Category

Post
 ├── belongsTo User
 ├── belongsTo Category
 └── hasMany Comments

Comment
 ├── belongsTo User
 └── belongsTo Post
```

The complete database specification lives in:

```text
docs/architecture/database.md
```

---

# API Contract

All API backends must follow the same contract.

## Authentication

```text
POST /api/register
POST /api/login
POST /api/logout
GET  /api/user
```

## Categories

```text
GET    /api/categories
POST   /api/categories
GET    /api/categories/{id}
PUT    /api/categories/{id}
DELETE /api/categories/{id}
```

## Todos

```text
GET    /api/todos
POST   /api/todos
GET    /api/todos/{id}
PUT    /api/todos/{id}
DELETE /api/todos/{id}
```

## Posts

```text
GET    /api/posts
POST   /api/posts
GET    /api/posts/{id}
PUT    /api/posts/{id}
DELETE /api/posts/{id}
```

## Comments

```text
GET    /api/posts/{post}/comments
POST   /api/posts/{post}/comments
PUT    /api/comments/{id}
DELETE /api/comments/{id}
```

The detailed contract is documented in:

```text
docs/api/
```

---

# How to Run It

## Requirements

Install:

- Git
- Docker Desktop
- Docker Compose

Verify:

```powershell
git --version
docker --version
docker compose version
```

---

## Clone the repository

```powershell
git clone https://github.com/YOUR_USERNAME/docker-fullstack-playground.git

cd docker-fullstack-playground
```

---

## Start infrastructure

```powershell
docker compose -f docker/compose/base.yml up -d
```

Check running containers:

```powershell
docker ps
```

---

## Run a backend

For example:

```powershell
docker compose `
    -f docker/compose/base.yml `
    -f docker/compose/laravel.yml `
    up -d
```

Check logs:

```powershell
docker compose logs -f
```

Stop everything:

```powershell
docker compose down
```

---

# How to Switch Backends

The main purpose of this project is being able to switch implementations easily.

For example:

```text
Frontend
   │
   │
   ▼
API URL
   │
   ├── Laravel
   ├── NestJS
   ├── FastAPI
   ├── Django
   ├── Go
   ├── Rust
   ├── .NET
   └── Spring Boot
```

The frontend should not need to know which backend technology is being used.

---

## Example

Start Laravel:

```text
API_URL=http://localhost:8000
```

Then switch to NestJS:

```text
API_URL=http://localhost:3000
```

The frontend application remains the same.

Only the API implementation changes.

For Vite applications:

```env
VITE_API_URL=http://localhost:8000
```

For Next.js:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000
```

For Nuxt:

```env
NUXT_PUBLIC_API_URL=http://localhost:8000
```

---

# How to Run Tests

The project uses **contract tests** to make sure every backend behaves according to the same API contract.

Example:

```text
tests/
└── contract/
    ├── auth/
    ├── categories/
    ├── todos/
    ├── posts/
    └── comments/
```

The same contract should be tested against every backend.

For example:

```text
                 Contract Tests
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
       Laravel       NestJS       FastAPI
          │            │            │
          ▼            ▼            ▼
       MySQL         MySQL         MySQL
```

A backend should not be considered complete until its contract tests pass.

Example:

```powershell
.\docker\scripts\test.ps1 laravel
```

or:

```powershell
.\docker\scripts\test.ps1 nest
```

The exact test commands are documented in:

```text
docs/development.md
```

---

# Development Tracker

## Phase 1 — Repository

- [ ] Create GitHub repository
- [ ] Initialize Git
- [ ] Add `README.md`
- [ ] Add `.gitignore`
- [ ] Add `.editorconfig`
- [ ] Add `LICENSE`
- [ ] Create project directories
- [ ] Add documentation structure

---

## Phase 2 — API Contract

- [ ] Define authentication contract
- [ ] Define category contract
- [ ] Define todo contract
- [ ] Define post contract
- [ ] Define comment contract
- [ ] Define validation rules
- [ ] Define HTTP status codes
- [ ] Define success response format
- [ ] Define error response format
- [ ] Define pagination format

---

## Phase 3 — Infrastructure

- [ ] Docker Compose base configuration
- [ ] MySQL
- [ ] PostgreSQL
- [ ] Redis
- [ ] Nginx
- [ ] Docker networking
- [ ] Persistent volumes
- [ ] Environment configuration
- [ ] PowerShell helper scripts

---

# Backend Tracker

## PHP

### Laravel API

- [ ] Docker setup
- [ ] Database configuration
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] API resources/responses
- [ ] Contract tests
- [ ] Documentation

### Laravel Livewire

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] UI
- [ ] Tests
- [ ] Documentation

### Laravel Inertia + Vue

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] UI
- [ ] Tests
- [ ] Documentation

### Laravel Inertia + React

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] UI
- [ ] Tests
- [ ] Documentation

### Laravel Inertia + Svelte

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] UI
- [ ] Tests
- [ ] Documentation

---

## Node.js

### Node.js

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

### NestJS

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

### AdonisJS

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

---

## Python

### FastAPI

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

### Flask

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

### Django

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

---

## Go

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

---

## Rust

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

---

## .NET

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

---

## Spring Boot

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] Validation
- [ ] Contract tests
- [ ] Documentation

---

# Frontend Tracker

## Vue

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] API configuration
- [ ] Laravel compatibility
- [ ] NestJS compatibility
- [ ] FastAPI compatibility
- [ ] Documentation

---

## React

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] API configuration
- [ ] Backend compatibility
- [ ] Documentation

---

## Svelte

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] API configuration
- [ ] Backend compatibility
- [ ] Documentation

---

## Nuxt

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] API configuration
- [ ] Backend compatibility
- [ ] Documentation

---

## Next.js

- [ ] Docker setup
- [ ] Authentication
- [ ] Categories
- [ ] Todos
- [ ] Posts
- [ ] Comments
- [ ] API configuration
- [ ] Backend compatibility
- [ ] Documentation

---

# Compatibility Tracker

The long-term goal is:

| Backend ↓ / Frontend → | Vue | React | Svelte | Nuxt | Next |
| ---------------------- | --: | ----: | -----: | ---: | ---: |
| Laravel                |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| NestJS                 |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| FastAPI                |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| Django                 |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| Go                     |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| Rust                   |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| .NET                   |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |
| Spring Boot            |  ⬜ |    ⬜ |     ⬜ |   ⬜ |   ⬜ |

A 🟢 entry means:

> This frontend has been verified to work against this backend using the project's API contract.

---

# Documentation Tracker

## API

- [ ] `docs/api/README.md`
- [ ] `docs/api/authentication.md`
- [ ] `docs/api/categories.md`
- [ ] `docs/api/todos.md`
- [ ] `docs/api/posts.md`
- [ ] `docs/api/comments.md`

## Architecture

- [ ] `docs/architecture/overview.md`
- [ ] `docs/architecture/networking.md`
- [ ] `docs/architecture/database.md`

## Development

- [ ] `docs/development.md`

---

# CI/CD Tracker

- [ ] GitHub Actions setup
- [ ] Backend contract tests
- [ ] Frontend builds
- [ ] Docker image builds
- [ ] Docker Compose validation
- [ ] Test every backend
- [ ] Test frontend/backend compatibility
- [ ] Pull request checks

---

# How to Contribute

This project is primarily a learning playground, but contributions are welcome.

Before adding a new backend or frontend:

1. Read the API contract.
2. Follow the existing project structure.
3. Use the same database model.
4. Implement the same API behavior.
5. Add Docker support.
6. Add contract tests.
7. Update the tracker.
8. Update the relevant documentation.

Create a branch:

```powershell
git switch -c feat/add-fastapi
```

Make your changes:

```powershell
git status
git diff
```

Commit:

```powershell
git add .
git commit -m "feat: add FastAPI backend"
```

Push:

```powershell
git push -u origin feat/add-fastapi
```

Then open a Pull Request.

---

# Development Philosophy

This project is not about building the biggest application.

It is about understanding how different technologies solve the **same problem**.

The application intentionally stays small:

```text
Authentication
     +
Categories
     +
Todos
     +
Posts
     +
Comments
```

The complexity comes from implementing the same system using different technologies.

That makes it possible to compare:

- Project structure
- Routing
- Controllers
- Services
- Dependency injection
- ORM
- Validation
- Authentication
- Serialization
- Error handling
- Testing
- Docker
- Networking
- Performance
- Developer experience

---

# Current Progress

> Update this section whenever a major milestone is completed.

```text
Repository       ⬜
API Contract     ⬜
Infrastructure   ⬜

Backends
────────
Laravel          ⬜
NestJS           ⬜
FastAPI          ⬜
Django           ⬜
Go               ⬜
Rust             ⬜
.NET             ⬜
Spring Boot      ⬜

Frontends
─────────
Vue              ⬜
React            ⬜
Svelte           ⬜
Nuxt             ⬜
Next.js          ⬜

Contract Tests   ⬜
CI/CD            ⬜
```

---

# Roadmap

```text
Phase 1
Repository + Documentation
        ↓
Phase 2
API Contract + Database
        ↓
Phase 3
Docker Infrastructure
        ↓
Phase 4
Laravel API
        ↓
Phase 5
Vue Frontend
        ↓
Phase 6
Contract Testing
        ↓
Phase 7
NestJS
        ↓
Phase 8
FastAPI / Django / Go
        ↓
Phase 9
Rust / .NET / Spring Boot
        ↓
Phase 10
React / Svelte / Nuxt / Next
        ↓
Phase 11
CI/CD + Full Compatibility Matrix
```

---

# Goal

The final goal is to have a playground where this is normal:

```text
                 ┌─────────────┐
                 │     Vue     │
                 └──────┬──────┘
                        │
                 ┌──────▼──────┐
                 │    API     │
                 └──────┬──────┘
                        │
          ┌─────────────┼─────────────┐
          ▼             ▼             ▼
      Laravel         NestJS       FastAPI
          │             │             │
          └─────────────┼─────────────┘
                        │
                   MySQL / Redis
```

Change the backend.

Keep the frontend.

Change the frontend.

Keep the backend.

Learn the difference.

Build the same thing again.

And understand **why each technology works the way it does**.
