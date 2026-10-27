# Form Requests

## Authorization & Validation

- Authorization and validation only ever happen in form requests: authorization in the `authorize` method, validation in the `rules` method.
- Never use policies or gates. No `app/Policies`, no `Gate::define`, no `can` middleware, no `$user->can()`, no `$this->authorize()`.
- Controllers and actions never check anything themselves. No `abort`, `abort_if`, `abort_unless`, `throw_if`, `throw_unless`, `$request->validate()`, or `ValidationException`.

## One Request Per Endpoint

- Create a dedicated form request for each endpoint that checks anything. Never share one between endpoints.
- If the endpoint doesn't have one yet, create one.
- Form requests are CRUD by design. Name them after the controller method they serve, followed by the model:
  - `index` → `IndexPostsRequest`
  - `show` → `ShowPostRequest`
  - `store` → `StorePostRequest`
  - `update` → `UpdatePostRequest`
  - `destroy` → `DestroyPostRequest`

## Input Interpretation

- Put input interpretation in form requests, as typed getter methods (e.g. `$request->status()`).
- Put complex checks in the `after()` hook or in custom validation rule classes.

## Enforcement

- These rules are enforced by arch tests in `tests/Unit/AuthorizationTest.php`.
