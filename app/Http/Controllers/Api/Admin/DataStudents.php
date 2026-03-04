<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\User;

class DataStudents extends Controller
{

    public function countStudents()
    {
        $students = User::count();
        return response()->json([
            'count' => $students,
        ]);
    }
    public function indexStudents()
    {
        $students = User::with('plan')->paginate(10);;

        return response()->json([
            'students' => StudentResource::collection($students),
        ]);
    }

}
