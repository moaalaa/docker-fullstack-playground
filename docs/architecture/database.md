# Database

## Canonical Model

The canonical logical model is independent of the ORM or database engine.

```text
users
  |
  +---- categories
  |       |
  |       +---- todos
  |       |
  |       +---- posts
  |               |
  |               +---- comments
  |
  +---- todos
  +---- posts
  +---- comments
```

## users

| Column     | Type         | Rules            |
| ---------- | ------------ | ---------------- |
| id         | uuid         | primary key      |
| name       | varchar(255) | required         |
| email      | varchar(255) | required, unique |
| password   | varchar(255) | required         |
| created_at | timestamp    | required         |
| updated_at | timestamp    | required         |

## categories

| Column     | Type         | Rules         |
| ---------- | ------------ | ------------- |
| id         | uuid         | primary key   |
| user_id    | uuid         | FK → users.id |
| name       | varchar(255) | required      |
| created_at | timestamp    | required      |
| updated_at | timestamp    | required      |

## todos

| Column      | Type         | Rules              |
| ----------- | ------------ | ------------------ |
| id          | uuid         | primary key        |
| user_id     | uuid         | FK → users.id      |
| category_id | uuid         | FK → categories.id |
| title       | varchar(255) | required           |
| description | text         | nullable           |
| completed   | boolean      | required           |
| created_at  | timestamp    | required           |
| updated_at  | timestamp    | required           |

## posts

| Column      | Type         | Rules              |
| ----------- | ------------ | ------------------ |
| id          | uuid         | primary key        |
| user_id     | uuid         | FK → users.id      |
| category_id | uuid         | FK → categories.id |
| title       | varchar(255) | required           |
| body        | text         | required           |
| created_at  | timestamp    | required           |
| updated_at  | timestamp    | required           |

## comments

| Column     | Type      | Rules         |
| ---------- | --------- | ------------- |
| id         | uuid      | primary key   |
| user_id    | uuid      | FK → users.id |
| post_id    | uuid      | FK → posts.id |
| body       | text      | required      |
| created_at | timestamp | required      |
| updated_at | timestamp | required      |

## Relationships

```text
User
 ├── hasMany Categories
 ├── hasMany Todos
 ├── hasMany Posts
 └── hasMany Comments

Category
 ├── belongsTo User
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

## Ownership

Every user-owned resource must be scoped to the authenticated user.

For example, user 1 must not be able to read or modify user 2's category, todo, post, or comment.
