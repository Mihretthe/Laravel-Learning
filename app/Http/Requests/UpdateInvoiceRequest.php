<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null & $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'PUT'){
            return [
            'customerId' => ['required'],
            'amount' => ['required'],
            'status' => ['required', Rule::in('B', 'P', 'V', 'b', 'p', 'v')],
            'billedDate' => ['required'],
            'paidDate' => [ 'required', 'nullable'],
        ];
        }

        return [
            'customerId' => [ 'sometimes' ,'required'],
            'amount' => [ 'sometimes' ,'required'],
            'status' => [ 'sometimes' ,'required', Rule::in('B', 'P', 'V', 'b', 'p', 'v')],
            'billedDate' => [ 'sometimes' ,'required'],
            'paidDate' => [  'sometimes' ,'required', 'nullable'],
        ];
    }
}
