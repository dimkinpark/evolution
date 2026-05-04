# ZM Evolution Changelog

All notable ZM-specific changes are documented in this file.
Upstream Evolution CMS changes are tracked in the regular CHANGELOG.md.

This project adheres to [Semantic Versioning](https://semver.org/) within the ZM scope:
- Versions follow the pattern `<upstream>-zm.<n>` (e.g. `1.4.6-zm.5`).
- The `<upstream>` part tracks the underlying Evo version.
- The `<n>` part is incremented for each ZM release.

---

## [Unreleased] — 1.4.x-zm.0

### Added
- Initial ZM fork infrastructure
- `README_ZM.md` — strategic overview of the fork
- `CHANGELOG_ZM.md` — this file
- `CORE_PATCHES_ZM.md` — registry for any patches to upstream Evo files
- `UPGRADE_ZM.md` — upgrade guidance template
- `IDEAS_ZM.md` — parking lot for future ideas
- `composer.json` — Composer dependency manifest
- Directory structure: `core/zm/src/`, `core/zm/tests/`, `manager/zm/`, `manager/media/style/zm/`, `migrations/zm/`, `assets/plugins/zm-*/`
- `.gitignore` additions for ZM-specific paths

### Changed
- None yet (no upstream files modified)

### Deprecated
- None

### Removed
- None

### Fixed
- None

### Security
- None
