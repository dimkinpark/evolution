# ZM Evolution

A fork of [Evolution CMS](https://github.com/evocms-community/evolution) maintained by [ZetMedia Studio](https://zmedia.by) with a small set of additional admin tools and content tooling used internally on client sites.

[![Upstream](https://img.shields.io/badge/upstream-evocms--community%2Fevolution-blue)](https://github.com/evocms-community/evolution)
[![Branch](https://img.shields.io/badge/branch-1.4.x--zm-green)]()
[![PHP](https://img.shields.io/badge/PHP-7.4-777BB4)]()
[![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)]()

---

## What this fork is

This fork tracks the upstream `1.4.x` branch and adds a few quality-of-life improvements that ZetMedia uses across the sites it builds and maintains.

It is designed so that **nothing is forced** on a site: by default the fork behaves like stock Evolution CMS, and individual ZM tools can be enabled site by site as needed.

If you install this fork without enabling anything, you get plain Evolution CMS plus whatever fixes have been pulled in from upstream.

---

## What's included

The current focus is two things that the studio needed in production:

- A separate manager theme (`zm`) that can be activated alongside the default one.
- A small set of admin tools accessible under `Tools → ZM Settings`.

Specific tooling lands incrementally and is documented in `CHANGELOG_ZM.md`.

---

## How it relates to upstream

- The `1.4.x` branch in this repository is a mirror of `evocms-community/evolution` `1.4.x` and is updated periodically.
- All ZM-specific work happens on `1.4.x-zm`.
- ZM code lives in dedicated paths (`core/zm/`, `manager/zm/`, `manager/media/style/zm/`, `migrations/zm/`, `assets/plugins/zm-*/`) so that merging from upstream stays straightforward.
- If a patch to an upstream file is ever required, it is recorded in `CORE_PATCHES_ZM.md` along with the reason.

---

## Requirements

- PHP 7.4
- MySQL 5.7+ or MariaDB 10.3+
- Standard Evolution CMS 1.4.x system requirements otherwise

---

## Installation

This fork is installed the same way as stock Evolution CMS. There is no extra installer step.

If you want to use any of the ZM tooling:

1. Switch the manager theme to `zm` under `Tools → Configuration → Manager Theme`.
2. Open `Tools → ZM Settings` and enable the tools you want to use.

If you don't do either of those, the fork is indistinguishable from stock Evolution CMS.

---

## Status

Active internal development. Intended primarily for ZetMedia client sites. External use is permitted under the inherited GPL-2.0-or-later license, but no compatibility or stability guarantees are made for use cases outside ZetMedia's own sites.

---

## License

GPL-2.0-or-later, inherited from Evolution CMS.

---

## Maintainer

[ZetMedia Studio](https://zmedia.by) · Grodno, Belarus · info@zmedia.by
