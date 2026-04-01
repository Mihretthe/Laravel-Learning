<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null & $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customer_id' => ['required', 'integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in('B', 'P', 'V', 'b', 'p', 'v')],
            '*.billedDate' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['date_format:Y-m-d H:i:s', 'nullable'],
        ];
    }

    protected function prepareForValidation()
    {

        $data = [];

        foreach ($this->toArray() as $obj) {
          
            $data[] = [
                'customer_id' => $obj['customerId'] ?? null,
                'amount' => $obj['amount'] ?? null,
                'status' => $obj['status'] ?? null,
                'billedDate' => $obj['billedDate'] ?? null,
                'paidDate' => $obj['paidDate'] ?? null,
            ];

        }

        $this->replace($data);

    }
}
