# ZM Evolution Upgrade Guide

This document explains how to upgrade an existing site from one ZM version to another.

> **Note:** As of 2026-05-04, ZM is in early development on the `1.4.x-zm.0` foundation. This document is a template that will be filled in as the first stable releases are tagged.

---

## General upgrade procedure

The upgrade flow for any ZM Evolution site is:

1. **Backup the database.**
   ```bash
   mysqldump -u USER -p DBNAME > backup_pre_zm_upgrade_$(date +%Y%m%d_%H%M).sql
   ```

2. **Backup the `assets/` directory** (if any custom files are stored there).

3. **Pull or download the new ZM version** into the site's webroot.

4. **Install Composer dependencies.**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

5. **Run pending migrations** through `Tools → ZM Settings → Migrations → Apply pending`, or via CLI:
   ```bash
   php manager/zm/migrate.php --apply
   ```

6. **Clear all caches** through `Site → Clear cache` (or `Tools → ZM Settings → System → Clear ZM cache`).

7. **Verify the site is working** (front-end and admin).

8. **Disable the maintenance flag** if you enabled one for the upgrade window.

---

## Version-specific notes

### Upgrading to 1.4.x-zm.1 (next release)

To be added when 1.4.x-zm.1 is tagged.

---

## Upgrading from stock Evolution CMS to ZM

If you currently run a stock Evolution CMS site and want to migrate to the ZM fork:

1. Backup database and `assets/`.
2. Replace the codebase with ZM Evolution (matching the same upstream `1.4.x.X` version).
3. Run `composer install`.
4. Run all ZM migrations from scratch (the migration runner detects a fresh installation).
5. The site will continue to behave like stock Evolution because all ZM modules are disabled by default.
6. Optionally enable ZM modules one at a time through Settings Hub.

This procedure is **fully reversible** — replacing the codebase back with stock Evolution restores original behavior. The only persistent change is the addition of `zm_*` settings and `zm_*` tables, which can be removed manually if desired.

---

## Downgrading

ZM follows a strict policy of **forward-compatible migrations** for the duration of a major version (`1.4.x-zm.*`). However, downgrading is not officially supported.

If you need to downgrade:

1. Restore the pre-upgrade database backup.
2. Restore the previous codebase version.
3. Restore `assets/` if it was modified.

Downgrading without a backup is unsupported and may leave the site in an inconsistent state.

---

## Multi-site upgrade strategy

For ZetMedia studio operating 100+ ZM sites:

1. **Pilot first** — apply the upgrade to one non-critical client site, monitor for 24-48 hours.
2. **Stage rollout** — upgrade in batches of 5–10 sites with monitoring between batches.
3. **Use ZM Multi-site** (when available) to coordinate upgrades from a central panel.
4. **Maintain a per-client compatibility matrix** documenting which ZM modules each client uses.

---

## Getting help

If an upgrade fails:

1. Capture the error message and PHP/MariaDB version.
2. Check `assets/cache/zm-migration.log` for migration runner output.
3. File an issue at the GitHub repository or contact info@zmedia.by.
