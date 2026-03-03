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
            'title_activity' => ['sometimes', 'string', 'max:255'],
            'description_activity' => ['sometimes', 'string'],
            'questions_activity' => ['sometimes', 'string'],

            'tb_alternatives' => ['sometimes', 'array', 'size:4'],

            'tb_alternatives.*.title_alternative' => ['required_with:tb_alternatives', 'string', 'size:1'],
            'tb_alternatives.*.text_alternative' => ['required_with:tb_alternatives', 'string'],
            'tb_alternatives.*.correct_alternative' => ['required_with:tb_alternatives', 'boolean'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $alternatives = $this->input('tb_alternatives', []);

            if (!empty($alternatives)) {
                $correctCount = collect($alternatives)
                    ->where('correct_alternative', true)
                    ->count();

                if ($correctCount !== 1) {
                    $validator->errors()->add(
                        'tb_alternatives',
                        'Deve existir exatamente uma alternativa correta.'
                    );
                }
            }
        });
    }
}
