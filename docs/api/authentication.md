# Authentication API

## User Object

```json
{
  "id": 1,
  "name": "Mohamed",
  "email": "mohamed@example.com",
  "created_at": "2026-09-22T10:00:00Z",
  "updated_at": "2026-09-22T10:00:00Z"
}
```

## Register

```http
POST /api/register
```

### Request

```json
{
  "name": "Mohamed",
  "email": "mohamed@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Validation

| Field | Rules |
|---|---|
| name | required, string, max 255 |
| email | required, valid email, unique |
| password | required, minimum 8 characters |
| password_confirmation | required, must match password |

### Response

Status: `201`

```json
{
  "data": {
    "user": {
      "id": 1,
      "name": "Mohamed",
      "email": "mohamed@example.com"
    },
    "token": "example-token"
  },
  "message": "Registered successfully"
}
```

## Login

```http
POST /api/login
```

### Request

```json
{
  "email": "mohamed@example.com",
  "password": "password123"
}
```

### Response

Status: `200`

```json
{
  "data": {
    "user": {
      "id": 1,
      "name": "Mohamed",
      "email": "mohamed@example.com"
    },
    "token": "example-token"
  },
  "message": "Login successful"
}
```

## Current User

```http
GET /api/user
Authorization: Bearer <token>
```

### Response

Status: `200`

```json
{
  "data": {
    "id": 1,
    "name": "Mohamed",
    "email": "mohamed@example.com"
  },
  "message": "Success"
}
```

## Logout

```http
POST /api/logout
Authorization: Bearer <token>
```

### Response

Status: `200`

```json
{
  "data": null,
  "message": "Logged out successfully"
}
```

## Invalid Credentials

Status: `401`

```json
{
  "message": "Invalid credentials."
}
```
