<?php

namespace App\Http\Controllers\Api\Course\ActivityCourse;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityCourseRequest;
use App\Models\ActivityCourse;
use App\Models\AlternativeActivityCourse;
use App\Models\Course;
use Illuminate\Http\Request;
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

    public function show(string $public_id, string $public_id_activity)
    {

        $course = Course::where('public_id', $public_id)->firstOrFail();

        $activity = ActivityCourse::where('fk_id_course', $course->id_course)
            ->where('public_id', $public_id_activity)
            ->firstOrFail();

        $alternatives = AlternativeActivityCourse::where(
            'fk_id_activity',
            $activity->id_activity
        )->get();

        return response()->json([
            'activity' => $activity,
            'alternatives' => $alternatives
        ]);
    }


    public function update(ActivityCourseRequest $request, string $public_id, string $public_id_activity) {


        return DB::transaction(function () use ($request, $public_id, $public_id_activity) {

            $course = Course::where('public_id', $public_id)
                ->firstOrFail();

            $activity = ActivityCourse::where('fk_id_course', $course->id_course)
                ->where('public_id', $public_id_activity)
                ->firstOrFail();

            $activity->update($request->only([
                'title_activity',
                'description_activity',
                'questions_activity'
            ]));

            $data = $request->validated();

            if (!empty($data['tb_alternatives'])) {

                foreach ($data['tb_alternatives'] as $alternativeData) {

                    $activity->alternatives()
                        ->where('title_alternative', $alternativeData['title_alternative'])
                        ->update([
                            'text_alternative' => $alternativeData['text_alternative'],
                            'correct_alternative' => $alternativeData['correct_alternative'],
                        ]);
                }
            }

            return response()->json([
                'message' => 'Atividade atualizada com sucesso.',
                'activity' => $activity->load('alternatives')
            ]);
        });
    }

    public function destroy(string $public_id, string $public_id_activity){
        $course = Course::where('public_id', $public_id)
            ->firstOrFail();

        $activity = ActivityCourse::where('fk_id_course', $course->id_course)
            ->where('public_id', $public_id_activity)
            ->firstOrFail();

        $activity->delete();

        return response()->json([
            'message' => 'Atividade apagada com sucesso.',
            'code' => 200
        ]);
    }

}
