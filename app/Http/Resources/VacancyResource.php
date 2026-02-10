<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_vacancy' => $this->id_vacancy,

            'area' => [
                'slug_area' => $this->area?->slug_area,
            ],

            'public_id' => $this->public_id,
            'slug_vacancy' => $this->slug_vacancy,
            'status_vacancy' => $this->status_vacancy,
            'title_vacancy' => $this->title_vacancy,
            'description_vacancy' => $this->description_vacancy,
            'requirements_vacancy' => $this->requirements_vacancy,
            'tasks_vacancy' => $this->tasks_vacancy,
            'start_date_vacancy' => $this->start_date_vacancy,
        ];
    }

}
