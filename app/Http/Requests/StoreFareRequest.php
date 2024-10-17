<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFareRequest extends FormRequest
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
            'designated_locality' => 'required|max:50',
            'vehicle' => 'required|max:20',
            'operating_hours' => 'required',
            'distance' => 'required',
            'initial_fare' => 'required',
            'additional_fare' => 'required',
            'discounted_fare' => 'required',
        ];
    }
}
