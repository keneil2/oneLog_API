<?php

declare(strict_types=1);

arch('controllers only have crud or invoke public methods')
    ->expect('App\Http\Controllers')
    ->not->toHavePublicMethodsBesides(['index', 'store', 'show', 'update', 'destroy', '__invoke']);

arch('controllers never authorize or validate')
    ->expect('App\Http\Controllers')
    ->not->toUse(['abort', 'abort_if', 'abort_unless', 'throw_if', 'throw_unless']);
