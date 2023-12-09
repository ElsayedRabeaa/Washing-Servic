<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscripeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|between:2,50',
            'last_name' => 'required|string|between:2,50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|numeric|max:11',
            'number' => 'required|string| |max:11',
            'zone_number' => 'required|numeric|',
            'building_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'car_model' => 'required',
            'car_color' => 'required',
            'car_number' => 'required|numeric',
            'Car_Wash_Schedule_Days' => 'required',
            'status' => 'required',
        ];
    }
}
