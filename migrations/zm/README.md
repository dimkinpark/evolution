# ZM Database Migrations

This directory holds versioned SQL migrations for ZM-specific schema changes.

## File naming convention

```
NNN-short-description.sql
```

Where `NNN` is a zero-padded sequential number starting from `001`.

Examples:
```
001-zm-settings-defaults.sql
002-zm-tree-indexes.sql
003-zm-archive-tables.sql
004-zm-image-meta-table.sql
```

## File structure

Each migration file is plain SQL with the following header conventions:

```sql
-- ============================================================================
-- ZM-NNN: <Title>
-- ============================================================================
-- Purpose:    What this migration does, in one sentence.
-- Target:     Evolution CMS 1.4.x with ZM fork.
-- Safety:     "Safe to run on production after backup."
--             OR "Locks tables — run during maintenance window."
-- Reversible: yes / no — if yes, see rollback section at the end.
-- Added in:   ZM version (e.g. 1.4.x-zm.5)
-- Author:     GitHub handle
-- Date:       YYYY-MM-DD
-- ============================================================================

-- (the actual SQL statements)

-- ============================================================================
-- Verification:
-- ============================================================================
-- (optional SQL queries that demonstrate the migration succeeded)

-- ============================================================================
-- Rollback:
-- ============================================================================
-- (SQL statements that undo this migration, if reversible)
```

## Idempotency

When possible, migrations should be **idempotent** — runnable multiple times without harmful effects. Use guards like:

```sql
-- Add column only if it doesn't exist
SET @col_exists := (
    SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'modx_site_content'
      AND COLUMN_NAME = 'zm_archived_at'
);

SET @sql := IF(@col_exists = 0,
    'ALTER TABLE modx_site_content ADD COLUMN zm_archived_at INT NULL',
    'SELECT "column already exists" AS message'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
```

The migration runner additionally records applied migrations in `modx_zm_migrations` and skips them on subsequent runs.

## Running migrations

### Via admin UI

`Tools → ZM Settings → Migrations → Apply pending`

### Via CLI

```bash
php manager/zm/migrate.php --apply
php manager/zm/migrate.php --apply --dry-run    # preview without applying
php manager/zm/migrate.php --status              # list applied/pending
```

### Manually (advanced users only)

```bash
mysql -u USER -p DBNAME < migrations/zm/001-zm-settings-defaults.sql
```

If running migrations manually, you must also insert a record into `modx_zm_migrations` to prevent the runner from re-applying the migration.

## Migration registry table

The migration runner maintains a registry table (created by migration `001`):

```sql
CREATE TABLE IF NOT EXISTS modx_zm_migrations (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    migration    VARCHAR(255) NOT NULL,
    applied_at   INT UNSIGNED NOT NULL,
    applied_by   VARCHAR(100) NULL,
    PRIMARY KEY (id),
    UNIQUE KEY migration_unique (migration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Testing migrations

Before merging a new migration:

1. Test on a fresh ZM installation (verify it applies cleanly).
2. Test on an existing ZM site (verify it co-exists with prior migrations).
3. If reversible, test the rollback statements.
4. Add an integration test in `core/zm/tests/Migration/`.

## Conflict resolution

If two developers create migration `005` on parallel branches:

1. Whoever merges to `1.4.x-zm` first keeps `005`.
2. The second developer must rename their migration to `006` before re-merging.
3. The migration runner detects out-of-order migrations and warns at apply time.
