<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
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
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'email' => ['required', 'email', 'max:150', 'unique:users,email'],
                'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number'],
                'date_of_birthday' => ['required', 'date', 'before:today'],
                'apresentation' => ['required', 'string', 'min:3', 'max:150'],
                'slug_plan' => ['required', 'exists:tb_plans,slug'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];

    }
}
