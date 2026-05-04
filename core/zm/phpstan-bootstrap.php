<?php

declare(strict_types=1);

/**
 * PHPStan bootstrap for ZM Evolution analysis.
 *
 * This file is loaded by PHPStan before static analysis runs. Its purpose
 * is to define constants, classes, or functions from Evolution CMS core
 * that ZM modules depend on but that PHPStan cannot infer on its own
 * (e.g. constants defined at runtime in /index.php or /manager/index.php).
 *
 * Stage 0: empty placeholder — no ZM code exists yet to analyse.
 *
 * Stage 1+ will add:
 * - Evo runtime constants (MODX_BASE_PATH, MODX_MANAGER_PATH, MODX_SITE_URL, etc.)
 * - Stub global $modx if needed for plugin/snippet analysis
 * - Any class_alias() shims required for ZM <-> Evo interop
 */
