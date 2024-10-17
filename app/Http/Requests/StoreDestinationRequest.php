<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'about' => 'nullable|string',
            'company_permit' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'location_clearance' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'barangay_clearance' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'philhealth' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'corporate_bank_account' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'sec_registration' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'tin' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'sss' => 'required|file|mimes:jpg,png,jpeg|max:5120',
            'destination_name' => 'required|string|max:255',
            'category' => 'required',
            'operating_hours' => 'required|string|max:100',
            'destination_address' => 'required|string|min:3|max:255',
            'locality' => 'required|string|min:3|max:20',
            'nearest_landmark1' => 'nullable|string|max:255',
            'nearest_landmark2' => 'nullable|string|max:255',
            'nearest_landmark3' => 'nullable|string|max:255',
            'amenities' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,approved,rejected',
            'user_id' => 'required',
        ];
    }
}
