# Docker Networking

## Host vs Container

A browser running on the host accesses a published container port through `localhost`.

Example:

```text
http://localhost:8000
```

A container communicating with another container uses the Docker service name.

Example:

```text
http://backend:8000
```

## Example

```text
Browser
   |
   | http://localhost:8000
   v
Backend Container
   |
   | mysql:3306
   v
MySQL Container
```

## Service Names

Given:

```yaml
services:
  backend:
    ...

  mysql:
    ...

  redis:
    ...
```

The backend should connect to:

```text
mysql:3306
redis:6379
```

not:

```text
localhost:3306
localhost:6379
```

## Frontend

A browser-based frontend normally uses the host-published API URL:

```env
VITE_API_URL=http://localhost:8000/api
```

A server-side framework may use an internal Docker URL for server-to-server requests when appropriate.

## Ports

Container ports and host ports are different concepts.

Example:

```yaml
ports:
  - "8000:8000"
```

means:

```text
Host:      localhost:8000
Container: 8000
```
