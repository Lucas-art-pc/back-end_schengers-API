<?php

namespace App\Http\Controllers\Api\Course\ClassCourse;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\Course;
use Illuminate\Http\Request;

class ClassCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $public_id)
    {
        $course = Course::with('classes')
            ->where('public_id', $public_id)
            ->first();

        if (!$course) {
            return response()->json([
                'message' => 'Curso não encontrado.',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'classCourse' => $course->classes,
            'status' => 200,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
