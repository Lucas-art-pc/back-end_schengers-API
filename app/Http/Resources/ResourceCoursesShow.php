<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceCoursesShow extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // ======================
            // Dados principais
            // ======================
            'public_id' => $this->public_id,
            'title_course' => $this->title_course,
            'description_course' => $this->description_course,
            'duration_course' => $this->duration_course,
            'is_paid' => (bool) $this->is_paid,
            'active_course' => (bool) $this->active_course,

            // ======================
            // Datas formatadas
            // ======================
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // ======================
            // Relacionamento: Area
            // ======================
            'area' => $this->whenLoaded('area', function () {
                return [
                    'id' => $this->area->id,
                    'name_area' => $this->area->name_area,
                    'slug_area' => $this->area->slug_area,
                    'created_at' => $this->area->created_at?->format('Y-m-d H:i:s'),
                ];
            }),

            // ======================
            // Relacionamento: Teacher
            // ======================
            'teacher' => $this->whenLoaded('teacher', function () {
                return [
                    'id' => $this->teacher->id,
                    'name' => $this->teacher->name,
                    'email' => $this->teacher->email,
                    'status' => $this->teacher->status ?? null,
                    'created_at' => $this->teacher->created_at?->format('Y-m-d H:i:s'),
                ];
            }),
        ];
    }
}
