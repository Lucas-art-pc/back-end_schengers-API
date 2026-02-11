<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurriculumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ajuste se usar policy
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',

            'linkedin' => 'nullable|url|max:255',
            'portfolio' => 'nullable|url|max:255',

            'education_level' => [
                'required',
                Rule::in(['graduacao', 'pos-graduacao', 'mestrado', 'doutorado']),
            ],

            'institution' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'graduation_year' => 'nullable|digits:4',

            'professional_experience' => 'nullable|string',
            'skills' => 'required|string',

            'personal_document' => 'required|string|max:255',

            'professional_document' => 'required|file|mimes:pdf|max:5120', // 5MB

            'status' => [
                'sometimes',
                Rule::in(['pending', 'approved', 'rejected']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'fk_id_vacancy.unique' =>
                'Você já enviou um currículo para esta vaga.',
        ];
    }
}
