<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\ResourceCourses;
use App\Http\Resources\ResourceCoursesShow;
use App\Models\Area;
use App\Models\Course;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::with('area')
            ->where('active_course', true)
            ->visibleTo($request->user())
            ->get();

        return ResourceCourses::collection($courses);
    }

    public function teacherCourses()
    {
        $teacherLogin = auth()->user();

        $courses = Course::with('area')
            ->where('fk_id_teacher', $teacherLogin->id)
            ->get();

        return ResourceCourses::collection($courses);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $data = $request->validated();


        $area = Area::where('slug_area', $data['slug_area'])
            ->firstOrFail();

        $course = Course::create([
            'fk_id_area'        => $area->id,
            'fk_id_teacher'     => 3,
            'title_course'      => $data['title_course'],
            'description_course'=> $data['description_course'],
            'duration_course'   => $data['duration_course'],
            'active_course'     => $data['active_course'],
            'is_paid'           => $data['is_paid'],
        ]);

        return response()->json([
            'message' => 'Curso criado com sucesso.',
            'course'  => new ResourceCourses($course->load('area'))
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $public_id)
    {
        $course = Course::with('area', 'teacher')
            ->where('public_id', $public_id)
            ->first();

        if (!$course) {
            return response()->json([
                'message' => 'Curso não encontrado.',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'course' => new ResourceCoursesShow($course),
            'status' => 200
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $public_id)
{
    try{


        $data = $request->all();

        $course = Course::where('public_id', $public_id)->firstOrFail();

        $course->update($data);

        return response()->json([
            'message' => 'Curso atualizada com sucesso!',
            'data' => $course
        ], 200);
    }catch(\Exception $e){
        return response()->json([
            'error' => $e->getMessage(),
            'message' => "Erro ao atualizar curso!",

        ]);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $public_id)
    {
        try {
            $vacancy = Course::where('public_id', $public_id)->firstOrFail();

            $vacancy->delete();

            return response()->json([
                'message' => 'Curso excluído com sucesso'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Curso não encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao excluir este curso!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
