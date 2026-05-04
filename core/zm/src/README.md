# ZM Core Source

This directory contains all ZM-specific PHP code, organized as a PSR-4 autoloaded namespace `ZM\*`.

## Layout

```
core/zm/src/
├── Module/           ← module loader, base classes, dependency injection
├── Settings/         ← Settings Hub: read/write zm_* settings
├── Migration/        ← migration runner, schema versioning
├── Database/         ← database access layer (typed queries, repositories)
├── Tree/             ← tree rendering, folder browser, bulk actions
├── Stats/            ← Yandex.Metrika integration, view counters
├── Article/          ← article meta (author, reading time, views)
├── Images/           ← upload processing, lazy load, imgproxy bridge
├── Archive/          ← archived documents handling
├── Editor/           ← block editor backend (JSON ↔ HTML)
├── Polls/            ← polls and quizzes
├── Api/              ← REST API for module functionality
├── Webhook/          ← outbound event notifications
├── MultiSite/        ← multi-site coordination (future)
├── Bootstrap.php     ← bridge between Evo globals and ZM container
└── Container.php     ← simple dependency injection container
```

## Coding standards

All files in this directory must:

1. **Begin with `<?php declare(strict_types=1);`** on the first line.
2. **Declare a namespace** matching the directory path (e.g. `ZM\Tree\FolderBrowser`).
3. **Use type hints** on all parameters, return types, and properties.
4. **Be `final` by default** — only mark classes/methods as non-final when extension is intentional.
5. **Avoid `global $modx`** — receive dependencies through the constructor instead.
6. **Pass PHPStan level 6+ analysis** without warnings.
7. **Pass PHP-CS-Fixer (PSR-12 + project rules)** without changes.
8. **Have unit tests** in `core/zm/tests/` mirroring the source structure.

## Bridge to Evolution CMS

ZM code does not access `$modx` directly. Instead, the `Bootstrap` class wraps the legacy global object into typed services that are then injected through the container.

Example (conceptual):

```php
// In a manager script (manager/zm/folder-browser.php):
require_once __DIR__ . '/../../core/zm/bootstrap.php';

$container = ZM\Bootstrap::create($modx);
$browser = $container->get(ZM\Tree\FolderBrowser::class);
$result = $browser->getChildren(2221, page: 1, limit: 50);
```

This indirection means that when Evolution CMS migrates to 1.5.0 or 3.x with a different API, only `Bootstrap` needs to be updated — the rest of ZM code remains unchanged.

## Adding a new module

1. Create `core/zm/src/<ModuleName>/` directory.
2. Add a class extending `ZM\Module\AbstractModule`.
3. Register the module in `core/zm/src/Module/Registry.php`.
4. Add tests in `core/zm/tests/<ModuleName>/`.
5. Add settings (if any) through `ZM\Settings\SettingsRepository`.
6. Add migrations (if any) in `migrations/zm/`.
7. Update `IDEAS_ZM.md` → roadmap status and `CHANGELOG_ZM.md`.

See `docs/MODULE_DEVELOPMENT.md` (to be added) for detailed guidance.
