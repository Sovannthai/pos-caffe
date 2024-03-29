<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExspendStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable',
            'exspend_note' => 'nullable',
        ];
    }
}
