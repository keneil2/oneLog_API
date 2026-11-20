---
name: feature
description: Build code one function at a time with the user in control of every decision. Grill the user about a single function (shape, inputs, outputs, failures, edge cases) with suggested answers, agree on tests first, then write only that function and surface any decision the user didn't make. Use when the user invokes /feature or asks to work function by function.
---

# Feature: one function at a time

The user wants to stay close to the code and own every decision. You do the typing; they do the deciding. Work on **one function per round**. Never jump ahead to the next function.

## The round

### 1. Listen

The user describes the function: what it's for and roughly how they picture it. If they haven't said where it lives (controller, action, model, request, etc.), that becomes a grill question, not a guess.

Before grilling, read the files the function will touch and their siblings so your suggestions follow existing conventions.

### 2. Grill

Ask **3–5 questions in one batch**, numbered. Only ask about decisions that actually matter for this function. Pick from:

- Location and name (file, class, method name)
- Inputs: parameters, types, nullable or not, where data comes from
- Output: return type, response shape, status code
- Failure: what happens on invalid input, missing records, unauthorized users
- Edge cases: empty values, duplicates, boundaries, concurrency
- Side effects: database writes, events, jobs, emails

**Every question includes a suggested answer** with a one-line reason, so the user can reply fast, e.g. `1 yes, 2 no use 422, 3 yes`.

Format:

```
1. <question>
   Suggested: <answer> — <why>
```

If an answer opens a new important question, ask it as a short follow-up. Don't run a second full grill.

### 3. Tests first

List the test names only (Pest `test('...')` descriptions), covering the happy path and the failures/edge cases agreed in the grill. Ask the user:

- add, cut, or rename any?
- do you want to write them, or should I?

If you write them, write only those tests. Follow the existing test file conventions. Then stop and let the user run them (red).

### 4. Implement

Write **only this function** and the minimum needed for it to work (e.g. a route line or a FormRequest rule it directly depends on). Follow the project's CLAUDE.md rules (`declare(strict_types=1);`, type hints, existing conventions). No extra features, refactors, or helpers that weren't agreed.

Do not run tests, artisan, pint, or git commands unless the user asks. Exception: `git add` any new file you create.

### 5. Decisions I made

After the code, list every choice you made that the user didn't explicitly decide, e.g.:

```
Decisions I made:
- Used firstOrFail() instead of a manual null check — returns 404 automatically.
- Named the relationship `owner` rather than `user`.
```

If there are none, say `Decisions I made: none`.

### 6. One thing to learn

One short note (2–4 lines) on something in this code worth knowing: a Laravel feature used, a pattern, a gotcha, or why something works. Skip it if there's genuinely nothing new.

### 7. Stop

End the round. Wait for the user to review, run the tests, and ask for changes or name the next function.

## Rules

- One function per round. Never batch functions.
- Never decide silently: anything unspecified goes in the grill or in "Decisions I made".
- Keep the grill tight; suggested answers are what make this fast.
- Keep diffs small enough to read in one pass.
