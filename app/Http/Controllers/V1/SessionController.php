<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Actions\CreateSessionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{
    public function store(StoreSessionRequest $request, CreateSessionAction $createSessionAction): JsonResponse
    {
        return $createSessionAction->handle($request->validated(),$request);
    }
}
