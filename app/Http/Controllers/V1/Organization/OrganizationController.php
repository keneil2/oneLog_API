<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1\Organization;

use App\Actions\StoreLogoAction;
use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():void{}


    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request,StoreLogoAction $action): JsonResponse
    {
        $file = $action->handle($request);

      Organization::create([...$request->only(["billing_address","name","type"]),'logo' => $file ? $file : null,'owner_id' => auth()->user()->id]);
      return ApiResponseHandler::success(message: "Organization Created Successfully!", status: ApiResponseHandler::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }

    /**
     * Check if the authenticated user owns an organization.
     */
    public function exists(): JsonResponse
    {
        $organizationExists = Organization::where('owner_id', auth()->user()->id)->exists();

        return ApiResponseHandler::success(message: "Organization check completed.", data: ['exists' => $organizationExists]);
    }
}
