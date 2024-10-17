<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'user_id' => 'required',
            'rating' => 'required|min:1|max:5',
            'proof' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'comment' => 'sometimes|min:10|max:100',
            'destination_id' => 'required',
            'status' => 'nullable',
        ];
    }
}
