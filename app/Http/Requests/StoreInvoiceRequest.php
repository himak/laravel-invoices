<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'invoice_number' => 'required|integer|min:1|max:99999999',
            'due_date' => 'required|date',
            'customer_id' => 'required|integer|exists:customers,id',
            'items' => 'required|array',
        ];
    }
}
