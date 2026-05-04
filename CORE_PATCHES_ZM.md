# ZM Core Patches Registry

This document tracks every modification made to upstream Evolution CMS files by the ZM fork.

## Why this registry exists

ZM Evolution is built as a **progressive enhancement layer** that aims to:

1. Stay mergeable with upstream `evocms-community/evolution`
2. Make it easy to identify ZM-specific changes during upstream merges
3. Document why each patch was necessary (when a hook/plugin/theme was insufficient)
4. Provide a clear roll-back path if a patch causes issues

Every modification to a file outside `core/zm/`, `manager/zm/`, `manager/media/style/zm/`, `assets/plugins/zm-*/`, or `migrations/zm/` **must** be recorded here.

---

## Patch Submission Template

When adding a new core patch, copy this block:

```markdown
### PATCH-XXX: <short title>

- **File:** `path/to/file.php`
- **Lines:** L42–L48 (approximate, will drift with upstream changes)
- **Reason:** Why a non-invasive solution (hook, plugin, theme override) was insufficient
- **Alternative considered:** What hook/event was missing that would have made this patch unnecessary
- **Upstream contribution:** Link to upstream PR if we're contributing the hook/event back, or "N/A" if patch is ZM-specific
- **Roll-back:** How to remove this patch if needed
- **Added in:** ZM version (e.g. `1.4.x-zm.5`)
- **Author:** GitHub handle
- **Date:** YYYY-MM-DD
```

---

## Active Patches

> **Status as of 2026-05-04:** zero core patches.
> All ZM functionality is delivered through plugins, themes, and the `manager/zm/` directory.

### (none yet)

---

## Removed Patches

> Patches that were once active but have since been removed (e.g. because upstream incorporated the change, or the feature was reimplemented without a patch).

### (none yet)

---

## Guidelines for Contributors

When you find yourself wanting to modify an upstream file:

1. **Stop.** Check if there is an existing event or hook in `evolutionCMS::invokeEvent()` that fits.
2. **Search plugins.** A plugin attached to the right event is almost always the correct solution.
3. **Try a theme override.** UI changes belong in `manager/media/style/zm/`.
4. **Try a snippet.** Frontend output transformations belong in snippets.
5. **Only if all of the above fail**, consider a core patch.

If you must add a core patch:

1. **Make it minimal.** A two-line patch is far easier to maintain than a fifty-line patch.
2. **Add a hook if possible.** If the patch adds an event invocation that didn't exist, contribute that event upstream — it benefits the entire community and removes the patch from our registry over time.
3. **Document it here** before merging.
4. **Mark it with a comment** in the patched file:
   ```php
   // ZM-PATCH-001: <short reason> — see CORE_PATCHES_ZM.md
   ```

---

## Upstream Merge Procedure

When merging from `evocms-community/evolution` upstream:

1. Pull the latest upstream into the `1.4.x` mirror branch.
2. Merge `1.4.x` into `1.4.x-zm`.
3. For each conflict, check this registry to see if the conflict involves a known patch.
4. Re-apply the patch in the new context if necessary.
5. Update line numbers in this registry to reflect the new file state.
6. Run the full test suite before pushing.
