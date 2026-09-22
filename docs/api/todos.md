# Todos API

Todos belong to a user and a category.

## Todo Object

```json
{
  "id": 1,
  "user_id": 1,
  "category_id": 1,
  "title": "Finish Docker playground",
  "description": "Complete the Laravel API",
  "completed": false,
  "created_at": "2026-09-22T10:00:00Z",
  "updated_at": "2026-09-22T10:00:00Z"
}
```

## List Todos

```http
GET /api/todos
Authorization: Bearer <token>
```

### Query Parameters

| Parameter | Default | Description |
|---|---:|---|
| page | 1 | Page number |
| per_page | 20 | Number of results, maximum 100 |

### Response

Status: `200`

```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "category_id": 1,
      "title": "Finish Docker playground",
      "description": "Complete the Laravel API",
      "completed": false,
      "created_at": "2026-09-22T10:00:00Z",
      "updated_at": "2026-09-22T10:00:00Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "per_page": 20,
    "total": 1
  }
}
```

## Create Todo

```http
POST /api/todos
Authorization: Bearer <token>
```

### Request

```json
{
  "category_id": 1,
  "title": "Finish Docker playground",
  "description": "Complete the Laravel API",
  "completed": false
}
```

### Validation

| Field | Rules |
|---|---|
| category_id | required, integer, category must exist and belong to user |
| title | required, string, max 255 |
| description | nullable, string |
| completed | required, boolean |

### Response

Status: `201`.

## Show Todo

```http
GET /api/todos/1
Authorization: Bearer <token>
```

Status: `200`.

## Update Todo

```http
PUT /api/todos/1
Authorization: Bearer <token>
```

### Request

```json
{
  "category_id": 1,
  "title": "Finish Docker playground",
  "description": "API and contract tests",
  "completed": true
}
```

All fields are validated using the same rules as creation.

### Response

Status: `200`.

## Delete Todo

```http
DELETE /api/todos/1
Authorization: Bearer <token>
```

### Response

Status: `204`.

The response body is empty.

## Ownership

Users can only read, update, and delete their own todos.
