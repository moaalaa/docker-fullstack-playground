# Posts API

Posts belong to a user and a category.

## Post Object

```json
{
  "id": 1,
  "user_id": 1,
  "category_id": 1,
  "title": "Learning Docker",
  "body": "Docker makes it easier to run different environments.",
  "created_at": "2026-09-22T10:00:00Z",
  "updated_at": "2026-09-22T10:00:00Z"
}
```

## List Posts

```http
GET /api/posts
Authorization: Bearer <token>
```

### Query Parameters

| Parameter | Default | Description |
|---|---:|---|
| page | 1 | Page number |
| per_page | 20 | Number of results, maximum 100 |

### Response

Status: `200`.

## Create Post

```http
POST /api/posts
Authorization: Bearer <token>
```

### Request

```json
{
  "category_id": 1,
  "title": "Learning Docker",
  "body": "Docker makes it easier to run different environments."
}
```

### Validation

| Field | Rules |
|---|---|
| category_id | required, integer, category must exist and belong to user |
| title | required, string, max 255 |
| body | required, string |

### Response

Status: `201`.

## Show Post

```http
GET /api/posts/1
Authorization: Bearer <token>
```

Status: `200`.

## Update Post

```http
PUT /api/posts/1
Authorization: Bearer <token>
```

### Request

```json
{
  "category_id": 1,
  "title": "Learning Docker",
  "body": "Updated post body."
}
```

### Response

Status: `200`.

## Delete Post

```http
DELETE /api/posts/1
Authorization: Bearer <token>
```

### Response

Status: `204`.

The response body is empty.

## Ownership

Users can only read, update, and delete their own posts.

Comments are owned by their author and belong to a post.
