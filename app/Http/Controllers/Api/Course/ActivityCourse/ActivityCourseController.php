<?php

namespace App\Http\Controllers\Api\Course\ActivityCourse;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityCourseRequest;
use App\Models\ActivityCourse;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class ActivityCourseController extends Controller
{
    //

    public function index(string $public_id)
    {
        $course = Course::with([
            'activities.alternatives'
        ])
            ->where('public_id', $public_id)
            ->first();

        if (!$course) {
            return response()->json([
                'message' => 'Curso não encontrado.',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'activities' => $course->activities,
            'status' => 200,
        ], 200);
    }

    public function store(ActivityCourseRequest $request, string $public_id)
    {


        $course = Course::where('public_id', $public_id)->firstOrFail();

        DB::transaction(function () use ($request, $course) {

            $activity = ActivityCourse::create([
                'title_activity' => $request->title_activity,
                'description_activity' => $request->description_activity,
                'question_activity' => $request->questions_activity,
                'fk_id_course' => $course->id_course,
            ]);

            foreach ($request->tb_alternatives as $alternative) {
                $activity->alternatives()->create($alternative);
            }
        });

        return response()->json([
            'message' => 'Atividade criada com sucesso',
        ], 201);
    }
}
