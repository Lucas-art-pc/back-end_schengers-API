<?php

namespace App\Http\Controllers\Api\StudyPlan;

use App\Http\Controllers\Controller;
use App\Models\StudyPlan;
use Illuminate\Http\Request;

class StudyPlanController extends Controller
{
    //
    public function index()
    {
        $studyPlan = StudyPlan::where('fk_id_student', auth()->id())->get();

        return response()->json([
            'plans' => $studyPlan,
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        $plan = StudyPlan::create([
            'fk_id_student' => auth()->id(),
            'day_of_week_study_plan' => $request->day_of_week_study_plan,
            'activity_study_plan' => $request->activity_study_plan,
            'description_study_plan' => $request->description_study_plan,
            'duration_study_plan' => $request->duration_study_plan,
        ]);

        return response()->json([
            'plans' => $plan,
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $plan = StudyPlan::where('id_plan_study', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $plan->update([
            'day_of_week_plan_study' => $request->day_of_week_plan_study ?? $plan->day_of_week_plan_study,
            'activity_plan_study' => $request->activity_plan_study ?? $plan->activity_plan_study,
            'description_plan_study' => $request->description_plan_study ?? $plan->description_plan_study,
            'duration_plan_study' => $request->duration_plan_study ?? $plan->duration_plan_study,
        ]);

        return response()->json([
            'message' => 'Plano atualizado com sucesso',
            'data' => $plan
        ]);
    }

    public function destroy($id)
    {
        StudyPlan::destroy($id);
        return response()->json([
            'message' => 'Plano excluído com sucesso',
            'status' => 200
            ]
        );
    }
}
