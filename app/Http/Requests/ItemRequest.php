<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'code' => [
                'required', Rule::unique('items', 'code')->ignore($this->item)
            ],
            'stock' => 'required|min:1',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'price_box' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
