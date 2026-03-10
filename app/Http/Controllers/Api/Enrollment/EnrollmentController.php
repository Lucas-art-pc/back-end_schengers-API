<?php

namespace App\Http\Controllers\Api\Enrollment;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    //

    public function coursesPerStudent(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'courses' => $user->courses
        ]);
    }

    public function enroll(Request $request, $public_id_course)
    {
        $user = $request->user();

        $course = Course::where('public_id', $public_id_course)->first();

        if (!$course) {
            return response()->json([
                'message' => 'Curso não encontrado'
            ], 404);
        }

        $user->courses()->syncWithoutDetaching([$course->id_course]);

        return response()->json([
            'message' => 'Matrícula realizada com sucesso'
        ]);
    }
}
