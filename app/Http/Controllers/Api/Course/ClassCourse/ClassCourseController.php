<?php

namespace App\Http\Controllers\Api\Course\ClassCourse;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassCourseRequest;
use App\Models\ActivityCourse;
use App\Models\AlternativeActivityCourse;
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


    public function store(ClassCourseRequest $request, string $public_id)
    {
        $course = Course::where('public_id', $public_id)->firstOrFail();

        $classCourse = ClassCourse::create([
            'title_class' => $request->title_class,
            'description_class' => $request->description_class,
            'explication_class' => $request->explication_class,
            'duration_class' => $request->duration_class,
            'url_class' => $request->url_class,
            'fk_id_course' => $course->id_course,
        ]);

        return response()->json([
            'message' => 'Aula cadastrada com sucesso.',
            'class' => $classCourse,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $public_id, string $public_id_class)
    {
        $course = Course::where('public_id', $public_id)->firstOrFail();

        $classCourse = ClassCourse::where('fk_id_course', $course->id_course)
            ->where('public_id', $public_id_class)
            ->firstOrFail();


        return response()->json([
            'classCourse' => $classCourse
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $public_id, string $public_id_class)
    {
        $course = Course::where('public_id', $public_id)->firstOrFail();
        $classCourse = ClassCourse::where('fk_id_course', $course->id_course)
            ->where('public_id', $public_id_class)
            ->first();
        if (!$classCourse) {
            return response()->json([
                'message' => 'Esta aula não está disponível.',
                'code' => 404,
            ]);
        }
        $classCourse->update(
            $request->only([
                'title_class',
                'description_class',
                'explication_class',
                'duration_class',
                'url_class'
            ])
        );
        return response()->json([
            'message' => 'Aula atualizada com sucesso.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $public_id, string $public_id_class){
        $course = Course::where('public_id', $public_id)
            ->firstOrFail();

        $activity = ClassCourse::where('fk_id_course', $course->id_course)
            ->where('public_id', $public_id_class)
            ->firstOrFail();

        $activity->delete();

        return response()->json([
            'message' => 'Aula apagada com sucesso.',
            'code' => 200
        ]);
    }
}
