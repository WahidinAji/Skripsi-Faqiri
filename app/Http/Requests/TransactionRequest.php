<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'code' => [
            //     'required', Rule::unique('transactions', 'code')->ignore($this->cart)
            // ],
            // 'date' => 'required|date',
            'price_total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'paying' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'refund' => 'nullable'
        ];
    }
}
