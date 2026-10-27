<?php

declare(strict_types=1);

test('no policies exist', function () {
    expect(is_dir(__DIR__.'/../../app/Policies'))->toBeFalse();
});

arch('gates are never used')
    ->expect('App')
    ->not->toUse([
        'Illuminate\Support\Facades\Gate',
        'Illuminate\Contracts\Auth\Access\Gate',
        'Illuminate\Foundation\Auth\Access\AuthorizesRequests',
    ]);

arch('controllers and actions never authorize or validate')
    ->expect(['App\Http\Controllers', 'App\Actions'])
    ->not->toUse([
        'abort',
        'abort_if',
        'abort_unless',
        'throw_if',
        'throw_unless',
        'Illuminate\Validation\ValidationException',
    ]);
