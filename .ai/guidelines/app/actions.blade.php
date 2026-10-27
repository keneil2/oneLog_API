# Actions

- This application uses the action pattern. Business logic lives in reusable, composable action classes.
- Actions live in `app/Actions`.
- Actions are named after what they do, with no suffix.
- Actions are called from many places: jobs, commands, HTTP requests, API requests and more.
- Create a dedicated action class for business logic with a single `handle` method.
- Inject dependencies via the constructor using private properties.
- Actions that don't require dependencies only have a `handle` method, with no constructor.
- Create new actions with `php artisan make:class Actions/Name --no-interaction`.
- Wrap complex operations in DB transactions within actions when multiple models are involved.
- Actions never authorize or validate. That lives in the form request of the endpoint calling them.

## Naming

- Actions are CRUD by design.
- Every action name starts with `Create`, `Update`, or `Delete`. Never use any other verb (no `Approve`, `Reject`, `Pin`, etc.).
- Name the rest after the model, relationship, or attribute being changed, and pass what changes as an argument, so one action covers every value.
