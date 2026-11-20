<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Http\Request;

final class StoreLogoAction
{
    public function handle(Request $request): ?string
    {
        if (! $request->hasFile('logo')) {
            return null;
        }

        $disk = config('filesystems.default');

        return $request->file('logo')->store('logos', $disk);
    }
}
