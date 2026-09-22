# Categories API

Categories belong to a user.

A category can contain:

- Todos
- Posts

## Category Object

```json
{
  "id": 1,
  "user_id": 1,
  "name": "Work",
  "created_at": "2026-09-22T10:00:00Z",
  "updated_at": "2026-09-22T10:00:00Z"
}
```

## List Categories

```http
GET /api/categories
Authorization: Bearer <token>
```

### Response

Status: `200`

```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "name": "Work",
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

## Create Category

```http
POST /api/categories
Authorization: Bearer <token>
```

### Request

```json
{
  "name": "Work"
}
```

### Validation

| Field | Rules |
|---|---|
| name | required, string, max 255 |

### Response

Status: `201`

```json
{
  "data": {
    "id": 1,
    "user_id": 1,
    "name": "Work",
    "created_at": "2026-09-22T10:00:00Z",
    "updated_at": "2026-09-22T10:00:00Z"
  },
  "message": "Category created successfully"
}
```

## Show Category

```http
GET /api/categories/1
Authorization: Bearer <token>
```

Status: `200`.

## Update Category

```http
PUT /api/categories/1
Authorization: Bearer <token>
```

### Request

```json
{
  "name": "Work & Projects"
}
```

### Response

Status: `200`.

## Delete Category

```http
DELETE /api/categories/1
Authorization: Bearer <token>
```

### Response

Status: `204`.

The response body is empty.

## Ownership

A user can only access, update, or delete their own categories.

A category cannot be deleted while it is referenced by one of the user's todos or posts unless the backend explicitly implements a documented cascade/reassignment rule. The canonical implementation should reject deletion while referenced with status `422`.
