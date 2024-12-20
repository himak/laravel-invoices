<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')
                    ->ignore(request()->user()->id),
            ],
            'business_name' => 'required|min:3|max:100',
            'identification_code' => [
                'required', 'max:30',
                Rule::unique('users', 'identification_code')
                    ->ignore(Auth::id()),
            ],
        ];
    }
}
