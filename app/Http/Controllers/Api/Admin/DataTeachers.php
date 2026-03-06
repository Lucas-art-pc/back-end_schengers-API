<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;

class DataTeachers extends Controller
{
    //

    public function countTeachers()
    {
        $teachers = Teacher::where('role', 'teacher')->where('status', 'approved')->count();
        return response()->json([
            'count' => $teachers,
        ]);
    }
    public function indexTeachers()
    {
        $teachers = Teacher::where('role', 'teacher')->where('status', 'approved')->paginate(10);;

        return response()->json([
            'students' => TeacherResource::collection($teachers),
        ]);
    }
}
