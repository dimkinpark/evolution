# ZM Manager Pages

This directory contains the entry-point PHP scripts for ZM admin functionality. Each file here is a thin wrapper that:

1. Bootstraps the ZM dependency container.
2. Resolves the appropriate ZM class.
3. Renders or returns a response.

The actual business logic lives in `core/zm/src/`.

## Planned entry points

```
manager/zm/
├── settings.php          ← Settings Hub (Tools → ZM Settings)
├── migrate.php           ← Migration Runner UI + CLI mode
├── folder-browser.php    ← Folder Browser (right panel for heavy folders)
├── stats.php             ← Stats dashboard (Yandex.Metrika + ZM views)
├── archive.php           ← Archive management
├── editor.php            ← Block editor entry (loaded inside document edit form)
├── api.php               ← REST API entry point (routes /zm/api/*)
└── bootstrap.php         ← shared bootstrap for all entry points
```

## Why entry points are in `manager/zm/` instead of integrated into Evo's manager

1. **Separation from upstream files** — none of these touch `manager/index.php` or other upstream code.
2. **Clear URL pattern** — every ZM admin page lives under `/manager/zm/`, easy to identify in logs and in nginx rules.
3. **Independent permissions** — these pages can have their own auth checks and access rules without conflicting with Evo's core permission system.
4. **API endpoints colocate with admin pages** — `manager/zm/api.php` serves the same purpose as Evo manager but for machine clients.

## Entry point template

Every script in this directory should follow this pattern (conceptual):

```php
<?php

declare(strict_types=1);

// 1. Standard Evo manager bootstrap (provides $modx, session, perms)
require_once __DIR__ . '/../includes/protect.inc.php';

// 2. ZM bootstrap (wraps $modx into typed container)
require_once __DIR__ . '/../../core/zm/bootstrap.php';

$container = \ZM\Bootstrap::create($modx);

// 3. Resolve the page controller and render
$controller = $container->get(\ZM\Settings\SettingsHubController::class);
$controller->handle();
```

Real implementations may include error handling, CSRF checks, and module activation guards.

## Manager menu integration

ZM pages are registered under Evo's manager menu via plugins in `assets/plugins/zm-*/`. The `OnManagerMenuPrerender` event is used to inject menu items.

Module plugins should not depend on each other for menu registration — each registers its own menu entries.
