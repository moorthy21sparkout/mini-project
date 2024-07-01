<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phonenumber' => 'required|string|max:10',
            'overall_total' => 'required|numeric',
        ];
    }
}
