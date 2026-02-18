<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ActionCurriculumController extends Controller
{
    //



    public function approveCurriculum(Curriculum $curriculum)
    {
        DB::transaction(function () use ($curriculum) {
            $curriculum->update([
                'status' => 'approved'
            ]);

            if ($curriculum->teacher) {
                $curriculum->teacher->update([
                    'status' => 'approved'
                ]);
            }
        });

        return response()->json([
            'message' => 'Currículo aprovado com sucesso.'
        ]);
    }



    public function rejectCurriculum(Curriculum $curriculum)
    {
        $curriculum->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'message' => 'Currículo não aceito com sucesso.'
        ]);
    }

}
