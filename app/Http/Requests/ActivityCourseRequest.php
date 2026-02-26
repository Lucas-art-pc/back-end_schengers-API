<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityCourseRequest extends FormRequest
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
            'title_activity' => ['required', 'string', 'max:255'],
            'description_activity' => ['required', 'string'],
            'questions_activity' => ['required', 'string'],

            'tb_alternatives' => ['required', 'array', 'size:4'],

            'tb_alternatives.*.title_alternative' => ['required', 'string', 'max:1'],
            'tb_alternatives.*.text_alternative' => ['required', 'string'],
            'tb_alternatives.*.correct_alternative' => ['required', 'boolean'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $correctCount = collect($this->tb_alternatives)
                ->where('correct_alternative', true)
                ->count();

            if ($correctCount !== 1) {
                $validator->errors()->add(
                    'tb_alternatives',
                    'Deve existir exatamente uma alternativa correta.'
                );
            }
        });
    }
}
