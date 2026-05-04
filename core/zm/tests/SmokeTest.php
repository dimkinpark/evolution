<?php

declare(strict_types=1);

namespace ZM\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Smoke test verifying that the ZM test infrastructure is wired correctly.
 *
 * This test exists to give PHPUnit something to run during Stage 0 CI before
 * any real ZM modules are implemented. It will be removed once Stage 1
 * brings real tests for the Settings Hub, Stats module, etc.
 */
final class SmokeTest extends TestCase
{
    public function testTestSuiteIsAlive(): void
    {
        self::assertTrue(true, 'PHPUnit harness is operational.');
    }

    public function testPhpVersionIsSupported(): void
    {
        self::assertTrue(
            version_compare(PHP_VERSION, '7.4.0', '>='),
            'ZM Evolution requires PHP 7.4 or newer.'
        );
    }
}
