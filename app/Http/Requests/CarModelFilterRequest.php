<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarModelFilterRequest extends FormRequest
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
            'brand_id'        => 'nullable|integer|exists:brands,id',
            'year_from'       => 'nullable|integer|min:2000|max:' . date('Y'),
            'year_to'         => 'nullable|integer|min:2000|max:' . date('Y'),
            'price_min'       => 'nullable|numeric|min:0',
            'price_max'       => 'nullable|numeric|min:0',
            'engine_id'       => 'nullable|integer|exists:engines,id',
            'transmission_id' => 'nullable|integer|exists:transmissions,id',
            'exterior_color'  => 'nullable|string|max:255',
            'interior_color'  => 'nullable|string|max:255',
        ];
    }
}
