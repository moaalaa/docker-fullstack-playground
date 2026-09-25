# Development Guide

## Requirements

- Git
- Docker Desktop
- Docker Compose
- The language/runtime required by the backend or frontend being developed

## Clone

```powershell
git clone https://github.com/YOUR_USERNAME/docker-fullstack-playground.git
cd docker-fullstack-playground
```

## Start Infrastructure

```powershell
docker compose -f docker/compose/base.yml up -d
```

## Start a Backend

Example:

```powershell
docker compose `
  -f docker/compose/base.yml `
  -f docker/compose/laravel.yml `
  up -d
```

## View Logs

```powershell
docker compose logs -f
```

## Stop

```powershell
docker compose down
```

## Backend Implementation Order

For every backend:

1. Create the application.
2. Add Docker support.
3. Connect the database.
4. Connect Redis if required.
5. Implement authentication.
6. Implement categories.
7. Implement todos.
8. Implement posts.
9. Implement comments.
10. Implement Bloom Filter (email uniqueness & resource ID existence checks).
11. Match response formats.
12. Match validation rules.
13. Run contract tests.
14. Document backend-specific setup.
15. Update the README tracker.

## Frontend Implementation Order

For every frontend:

1. Create the application.
2. Add Docker support.
3. Configure the API URL.
4. Implement authentication.
5. Implement categories.
6. Implement todos.
7. Implement posts.
8. Implement comments.
9. Test against at least two different compatible backends.
10. Update the README tracker.

## Contract Test Requirement

A backend is not considered complete until all applicable contract tests pass.

The contract tests are in:

```text
tests/contract/
```

## Git Workflow

```powershell
git switch -c feat/add-fastapi
git status
git diff
git add .
git commit -m "feat: add FastAPI backend"
git push -u origin feat/add-fastapi
```
