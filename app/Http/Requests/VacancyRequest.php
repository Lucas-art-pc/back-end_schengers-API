<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return $this->user()?->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug_area' => 'string|required|exists:tb_areas,slug_area',
            'title_vacancy' => 'string|required',
            'description_vacancy' => 'string|required',
            'requirements_vacancy' => 'string|required',
            'tasks_vacancy' => 'string|required',
            'status_vacancy' => 'boolean|required',
            'start_date_vacancy' => 'date|required',
        ];
    }
}
