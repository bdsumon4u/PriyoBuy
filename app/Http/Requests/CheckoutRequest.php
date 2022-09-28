<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => Str::startsWith($this->phone, '0') ? '+88'.$this->phone : $this->phone,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isMethod('POST') ? [
            'name' => 'required',
            'phone' => 'required|regex:/^\+8801\d{9}$/',
            'email' => 'nullable',
            'district' => 'nullable',
            'thana' => 'nullable',
            'address' => 'required',
            'note' => 'nullable',
            'products' => 'required|array',
            'shipping' => 'required',
        ] : [];
    }
}
