<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'business_name' => 'required|min:3|max:100|unique:users,business_name,'.\Auth::id(),
            'identification_code' => 'required|max:30|unique:users,identification_code,'.\Auth::id(),
        ];
    }
}
