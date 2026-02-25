<?php

namespace App\Http\Controllers\Api\Course\ActivityCourse;

use App\Http\Controllers\Controller;
use App\Models\Course;

class ActivityCourseController extends Controller
{
    //

    public function index(string $public_id)
    {
        $course = Course::with('activities')
            ->where('public_id', $public_id)
            ->first();

        if (!$course) {
            return response()->json([
                'message' => 'Curso não encontrado.',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'classCourse' => $course->activities,
            'status' => 200,
        ], 200);
    }
}
