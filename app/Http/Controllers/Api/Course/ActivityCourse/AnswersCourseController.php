<?php

namespace App\Http\Controllers\Api\Course\ActivityCourse;

use App\Http\Controllers\Controller;
use App\Models\ActivityCourse;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;

class AnswersCourseController extends Controller
{
    //

    public function answer(Request $request)
    {

        $user = $request->user();
        $data = $request->validate([
            'question_id' => 'required|exists:tb_activity,id_activity',
            'alternative_id' => 'required|exists:tb_alternative,id_alternative'
        ]);

        StudentAnswer::updateOrCreate(
            [
                'fk_id_student' => $user->id,
                'fk_id_activity' => $data['question_id']
            ],
            [
                'fk_id_alternative' => $data['alternative_id']
            ]
        );

        return response()->json([
            'message' => 'Resposta salva com sucesso'
        ]);
    }

    public function getAnswer(Request $request, $public_id_activity)
    {
        $user = $request->user();

        $activity = ActivityCourse::where('public_id', $public_id_activity)->first();

        $answer = StudentAnswer::where('fk_id_student', $user->id)
            ->where('fk_id_activity', $activity->id_activity)
            ->first();

        return response()->json([
            'answer' => $answer
        ]);
    }
}
