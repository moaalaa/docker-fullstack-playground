# API Contract Tests

These fixtures define executable test cases for every backend.

Each JSON file contains:

- `method`: HTTP method
- `path`: API path
- `auth`: whether a bearer token is required
- `body`: request JSON, when applicable
- `expect.status`: required HTTP status
- `expect.body`: required response values

## Dynamic Assertions

The following placeholders are used:

```text
<non-empty>  value must exist and not be empty
<array>      value must be an array
<number>     value must be numeric
```

Dot notation refers to nested JSON properties:

```text
data.user.email
meta.current_page
```

The fixtures are intentionally backend-neutral. A test runner should load them, send the request to the selected backend, and compare the response against the assertions.

## Test User

The backend test environment must seed this user:

```json
{
  "id": 1,
  "name": "Contract User",
  "email": "contract-user@example.com",
  "password": "password123"
}
```

It should also seed:

```text
Category ID: 1
Post ID: 1
Todo ID: 1
Comment ID: 1
```

The exact timestamps are not tested.

## Important

The fixtures are the contract. Framework-specific tests should not change the expected API behavior.

A backend-specific test may add additional tests, but it must still pass these contract tests.
