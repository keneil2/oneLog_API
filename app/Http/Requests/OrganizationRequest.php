<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Organization;
use Illuminate\Auth\Access\AuthorizationException;
class OrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $HasOrg = Organization::where("owner_id", auth()->user()->id)->exists();
        return !$HasOrg;
    }
    
    protected function failedAuthorization(): void
{
    throw new AuthorizationException('You already created an organization.');
}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:individual,company,personal'],
            'billing_address' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'max:255', 'file', 'mimes:jpeg,png'],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Validation errors occurred.',
            'errors' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
