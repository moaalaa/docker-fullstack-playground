# Comments API

Comments belong to:

- One user
- One post

## Comment Object

```json
{
  "id": 1,
  "user_id": 1,
  "post_id": 1,
  "body": "This is a great post.",
  "created_at": "2026-09-22T10:00:00Z",
  "updated_at": "2026-09-22T10:00:00Z"
}
```

## List Comments

```http
GET /api/posts/1/comments
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
      "post_id": 1,
      "body": "This is a great post.",
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

## Create Comment

```http
POST /api/posts/1/comments
Authorization: Bearer <token>
```

### Request

```json
{
  "body": "This is a great post."
}
```

### Validation

| Field | Rules |
|---|---|
| body | required, string |

### Response

Status: `201`.

## Update Comment

```http
PUT /api/comments/1
Authorization: Bearer <token>
```

### Request

```json
{
  "body": "Updated comment."
}
```

### Response

Status: `200`.

## Delete Comment

```http
DELETE /api/comments/1
Authorization: Bearer <token>
```

### Response

Status: `204`.

The response body is empty.

## Ownership

Users can only update or delete their own comments.
