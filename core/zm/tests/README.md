# ZM Tests

PHPUnit test suite for ZM-specific code.

## Layout

The test directory mirrors `core/zm/src/` structure:

```
core/zm/tests/
├── Module/
├── Settings/
├── Migration/
├── Tree/
├── Stats/
├── ...
└── bootstrap.php   ← test environment setup
```

## Running tests

From the repository root:

```bash
composer test                  # run full suite
vendor/bin/phpunit              # equivalent
vendor/bin/phpunit core/zm/tests/Tree/   # run a subset
```

## What to test

- **Unit tests**: every public method of every ZM class.
- **Integration tests**: migrations, especially when they alter schema.
- **API tests**: every REST endpoint, with mocked authentication and
  realistic payloads.

## What NOT to test in this directory

- Stock Evolution CMS code is out of scope.
- Manual UI testing happens in the browser, not here. Future end-to-end
  tests (Playwright/Cypress) will live in a separate `e2e/` directory.

## Naming conventions

- Test class names end with `Test` (e.g. `FolderBrowserTest`).
- Test method names start with `test` (e.g. `testGetChildrenReturnsEmptyWhenParentMissing`).
- Data providers are named `provideXxx` (e.g. `provideValidParents`).
