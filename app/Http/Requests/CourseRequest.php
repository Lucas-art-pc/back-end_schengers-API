<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'slug_area' => [
                'required',
                'string',
                'exists:tb_areas,slug_area'
            ],

            'title_course' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'description_course' => [
                'required',
                'string',
                'min:10'
            ],

            'duration_course' => [
                'required',
                'integer',
                'min:1'
            ],

            'active_course' => [
                'required',
                'boolean'
            ],

            'is_paid' => [
                'required',
                'boolean'
            ],
        ];
    }
}
