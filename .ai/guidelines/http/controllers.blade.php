# Controllers

- Controllers are CRUD by design. Their only public methods are `index`, `store`, `show`, `update`, and `destroy`.
- Never create controller files directly. Always create them with `php artisan make:controller V1/NameController --api --no-interaction`.
- Never add custom methods (no `approve`, `markAsRead`, etc.) unless explicitly asked to.
- When an endpoint does not fit CRUD, use an invocable controller with a single `__invoke` method: `php artisan make:controller V1/NameController --invokable --no-interaction`.
- Controller names are nouns, never verbs.
- Controllers stay thin: resolve the form request, call one action or query, and return a response.
- Controllers never authorize or validate anything. No `abort`, `abort_if`, `abort_unless`, `throw_if`, `throw_unless`.
- These rules are enforced by an arch test in `tests/Unit/ControllersTest.php`.
