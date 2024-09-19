<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarModelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand_id'        => 'required|exists:brands,id',
            'price'           => 'required|numeric|min:1000|max:1000000',
            'year'            => 'required|integer|between:2000,' . date('Y'),
            'engine_id'       => 'required|integer|exists:engines,id',
            'transmission_id' => 'required|integer|exists:transmissions,id',
            'exterior_color'  => 'required|string|max:255',
            'interior_color'  => 'required|string|max:255',
        ];
    }

}
