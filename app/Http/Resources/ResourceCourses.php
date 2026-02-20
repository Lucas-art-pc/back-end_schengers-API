<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceCourses extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title_course'   => $this->title_course,
            'slug_course'    => $this->slug_course,
            'duration_course'=> $this->duration_course,
            'is_paid'        => $this->is_paid,
            'active_course'  => $this->active_course,

            'name_area'  => $this->area?->name_area,
            'icon_area'  => $this->area?->icon_area,
            'color_area' => $this->area?->color_area,
        ];
    }
}
