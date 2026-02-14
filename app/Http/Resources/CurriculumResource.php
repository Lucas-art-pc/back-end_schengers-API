<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_curriculum' => $this->id_curriculum,

            'teacher' => [
                'name' => $this->teacher?->name,
                'email' => $this->teacher?->email,
            ],

            'vacancy' => [
                'title' => $this->vacancy?->title_vacancy,
                'slug' => $this->vacancy?->slug_vacancy,
            ],

            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'linkedin' => $this->linkedin,
            'portfolio' => $this->portfolio,
            'education_level' => $this->education_level,
            'institution' => $this->institution,
            'course' => $this->course,
            'graduation_year' => $this->graduation_year,
            'professional_experience' => $this->professional_experience,
            'skills' => $this->skills,
            'personal_document' => $this->personal_document,
            'professional_document' => $this->professional_document,
            'status' => $this->status,

        ];
    }
}
