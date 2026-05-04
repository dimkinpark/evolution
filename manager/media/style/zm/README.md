# ZM Manager Theme

A separate manager theme for ZM Evolution. Selected from `Tools → Configuration → Manager Theme → zm`.

## Important: this theme does NOT replace the default theme

The stock `default` theme remains untouched in this fork. This `zm` theme is a **parallel option** that site administrators can switch to if they want ZM enhancements. Switching back to `default` at any time fully restores standard Evolution behavior.

## Initial state

In the very first commits of the ZM fork, this directory is essentially a copy of `manager/media/style/default/` with minimal differentiation (e.g. a footer line "ZM Manager Theme" so the active theme is visible).

Subsequent ZM modules (Tree Limiter, Folder Browser, Stats dashboard, etc.) layer their UI changes here.

## Layout

```
manager/media/style/zm/
├── style.css                ← inherits/extends default theme styles
├── layout.css               ← admin layout overrides
├── tree.css                 ← tree-specific styles (ZM Tree module)
├── components/              ← reusable UI components
│   ├── buttons.css
│   ├── forms.css
│   ├── tables.css
│   └── modals.css
├── js/
│   ├── core/                ← shared utilities (api wrapper, event bus, ui helpers)
│   ├── tree/                ← tree limiter, folder browser
│   ├── settings/            ← settings hub
│   ├── stats/               ← stats dashboard
│   └── editor/              ← block editor (when available)
├── images/                  ← icons, logos, decorations
├── fonts/                   ← (if any web fonts are added)
└── ajax.php                 ← ZM-patched version of default's ajax.php
                                (see CORE_PATCHES_ZM.md if any patches are needed)
```

## Design system reference

Visual design tokens (colors, typography, spacing, icon set) are defined in the **ZM Theme Toolkit** module (`core/zm/src/ThemeToolkit/`). The CSS files in this directory consume those tokens through CSS custom properties.

## Switching themes safely

Site administrators can switch between `default` and `zm` themes at any time:

- **default → zm**: ZM modules become visible if enabled. No database changes occur.
- **zm → default**: ZM admin pages remain functional via direct URL (`/manager/zm/...`), but they are not linked from the default menu. ZM-specific UI in document edit forms (e.g. block editor) reverts to TinyMCE.

This bidirectional safety is one of the foundational principles of ZM.

## CSS strategy

- **No build step** in Phase 1 — plain CSS with custom properties.
- **No CSS-in-JS** — keeps the theme inspectable in DevTools.
- **Class prefix**: `zm-` for all ZM-specific classes to avoid collisions with default theme.
- **No `!important`** unless overriding a problematic third-party style.

## JS strategy

- **ES6 modules** loaded via `<script type="module" src="...">`.
- **No bundler** in Phase 1 — modules import each other directly.
- **No external runtime dependencies** in Phase 1 — only what's already in Evo (jQuery is available but avoid for new code).
- **TypeScript / Vite migration** is planned for Phase 2 when the block editor lands.
