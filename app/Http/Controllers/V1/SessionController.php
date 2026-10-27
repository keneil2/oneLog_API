<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function store(StoreSessionRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            // look up repsonse approaches
        }
    }
}
