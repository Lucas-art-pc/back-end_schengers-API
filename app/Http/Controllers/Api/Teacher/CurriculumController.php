<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurriculumRequest $request, Vacancy $vacancy)
    {
        $teacher = auth()->user()->teacher;

        $data = $request->validated();

        $data['fk_id_teacher'] = $teacher->id;
        $data['fk_id_vacancy'] = $vacancy->id_vacancy;

        /*if ($request->hasFile('professional_document')) {
            $data['professional_document'] =
                $request->file('professional_document')
                    ->store('curriculums', 'public');
        }*/

        $curriculum = Curriculum::create($data);

        return response()->json([
            'message' => 'Currículo enviado com sucesso!',
            'data' => $curriculum,
        ], 201);
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
