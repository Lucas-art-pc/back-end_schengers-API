<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexFreeAndUser()
    {
        $courses = Course::select('tb_courses.*')
            ->join('tb_areas', 'tb_courses.fk_area', '=', 'tb_areas.id')
            ->where('tb_courses.is_paid', false)
            ->where('tb_courses.active_course', true)
            ->orderBy('tb_areas.name_area', 'desc')
            ->with('area')
            ->get();

        return response()->json([
            'courses' => $courses
        ]);
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
