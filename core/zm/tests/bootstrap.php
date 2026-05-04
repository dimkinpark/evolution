<?php

declare(strict_types=1);

/**
 * PHPUnit bootstrap for ZM Evolution test suite.
 *
 * This file is loaded by PHPUnit before running the test suite. Its purpose
 * is to set up the test environment: register Composer's autoloader, define
 * any constants tests rely on, and (in later stages) bootstrap a minimal
 * Evolution CMS environment for integration tests.
 *
 * Stage 0: minimal — only Composer autoloading.
 *
 * Stage 1+ will add:
 * - Test-only constants (MODX_BASE_PATH for fixtures, etc.)
 * - In-memory SQLite test DB setup for migration tests
 * - Mock Evo globals where needed
 */

require_once __DIR__ . '/../../../vendor/autoload.php';
