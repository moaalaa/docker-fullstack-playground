# Architecture

## Goal

The project implements one small application using multiple backend and frontend technologies.

The API contract is the boundary between frontend and backend.

```text
Frontend
    |
    | HTTP + JSON
    v
Backend API
    |
    +---- Database
    |
    +---- Redis
```

## Backend Independence

A backend must not depend on a particular frontend.

A frontend must not depend on a particular backend.

If two backends implement the same API contract, the same frontend should be able to use either one by changing only its API configuration.

## Reference Flow

```text
Vue
 |
 | HTTP
 v
Laravel API
 |
 +---- MySQL
 +---- Redis
```

Can be replaced with:

```text
Vue
 |
 | HTTP
 v
FastAPI
 |
 +---- PostgreSQL
 +---- Redis
```

without changing the Vue application's API behavior.

## Canonical Domain

```text
User
 |
 +---- Categories
 |       |
 |       +---- Todos
 |       |
 |       +---- Posts
 |               |
 |               +---- Comments
 |
 +---- Todos
 +---- Posts
 +---- Comments
```
