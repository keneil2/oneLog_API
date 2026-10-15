<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(RegistrationRequest $request)
    {
        $user = User::create($request->validated());
    }
}
