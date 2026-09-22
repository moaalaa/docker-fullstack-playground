# API Documentation

## Purpose

This directory defines the canonical API contract for every backend implementation in this repository.

A backend is compatible when it follows these endpoints, request fields, response shapes, validation rules, authentication rules, and HTTP status codes.

## Base URL

The base URL depends on the backend being run.

Example:

```text
http://localhost:8000/api
```

All paths in this documentation are relative to the API base URL.

## Content Type

Requests containing a body use:

```http
Content-Type: application/json
Accept: application/json
```

## Authentication

Protected endpoints require:

```http
Authorization: Bearer <token>
```

Authentication is token-based for API implementations.

## Common Response Format

### Single Resource

```json
{
  "data": {},
  "message": "Success"
}
```

### Collection

```json
{
  "data": [],
  "meta": {
    "current_page": 1,
    "per_page": 20,
    "total": 0
  }
}
```

### Validation Error

```json
{
  "message": "Validation failed",
  "errors": {
    "title": [
      "The title field is required."
    ]
  }
}
```

### Authentication Error

```json
{
  "message": "Unauthenticated."
}
```

### Not Found

```json
{
  "message": "Resource not found."
}
```

## HTTP Status Codes

| Status | Meaning |
|---:|---|
| 200 | Successful request |
| 201 | Resource created |
| 204 | Resource deleted with no response body |
| 401 | Authentication required or invalid |
| 403 | Authenticated user is not allowed |
| 404 | Resource does not exist |
| 422 | Validation failed |
| 500 | Unexpected server error |

## Resources

- [Authentication](./authentication.md)
- [Categories](./categories.md)
- [Todos](./todos.md)
- [Posts](./posts.md)
- [Comments](./comments.md)
