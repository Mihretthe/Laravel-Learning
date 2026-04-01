<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerId' => ['required'],
            'amount' => ['required'],
            'status' => ['required', Rule::in('B', 'P', 'V', 'b', 'p', 'v')],
            'billedDate' => ['required'],
            'paidDate' => [ 'required', 'nullable'],
        ];
    }
}
