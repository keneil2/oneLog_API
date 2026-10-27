# General

- Always add `declare(strict_types=1);` to every PHP file. This is enforced by Pint's `declare_strict_types` rule and an arch test in `tests/Unit/GeneralTest.php`.
- Don't include any superfluous PHP annotations, except ones that start with `@` for typing variables.
- Every time you create a new file, stage it immediately with `git add <path>`. Never commit; leave committing to the user.
- Migrations only go up: never write a `down` method. To undo a migration, write a new one.

## Minimal code

- Write the least code that does the job: no private helpers, extra cache layers, or defensive checks the feature doesn't need. If a method can be inlined or a branch removed without losing behavior, do it.
- Prefer Laravel collections and the framework's typed accessors over hand-written array handling: `collect(...)->map(...)` instead of building arrays in loops, `$response->collect()` / `$response->fluent()` with `->integer()` / `->string()` instead of `is_array` / `is_numeric` checks and `(int)` casts.
- For very large or repeated array shapes, define a named `@phpstan-type` alias on the class that owns the data and reuse it in PHPDoc annotations. Use `@phpstan-import-type` in other classes instead of duplicating the shape; keep small, one-off shapes inline.

## Required verification

- After changes, before reporting completion or pushing, run `composer test:lint` (Pint), `composer test:types` (PHPStan), and `composer test:type-coverage` (Pest type coverage, 100% minimum).
- Fix failures introduced by the changes. Never lower thresholds or exclude code just to pass. Report pre-existing failures or environment blockers explicitly; do not claim a check passed when it failed or could not run.
