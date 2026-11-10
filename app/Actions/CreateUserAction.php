<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
final class CreateUserAction
{
    public function handle(array $data): User
    {
          
        $user = User::create($data);
        event(new Registered($user));
        return $user;
    }
}
