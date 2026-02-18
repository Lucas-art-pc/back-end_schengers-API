<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumRequest;
use App\Http\Resources\CurriculumResource;
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

    public function indexByVacancy($slug_vacancy)
    {
        $vacancy = Vacancy::where('slug_vacancy', $slug_vacancy)
            ->firstOrFail();

        $curriculums = $vacancy->curriculums()
            ->latest()
            ->paginate(5);

        return response()->json(CurriculumResource::collection($curriculums), 200);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(CurriculumRequest $request, Vacancy $vacancy)
    {



        $data = $request->validated();

        $data['fk_id_teacher'] = 1;
        $data['fk_id_vacancy'] = $vacancy->id_vacancy;
        $data['status'] = 'pending';

        if ($request->hasFile('professional_document')) {
            $data['professional_document'] =
                $request->file('professional_document')
                    ->store('curriculums', 'public');
        } else {
            // permite teste com texto
            $data['professional_document'] = $request->professional_document;
        }


        $curriculum = Curriculum::create($data);

        return response()->json([
            'message' => 'Currículo enviado com sucesso!',
            'data' => $curriculum,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $public_id)
    {
        $curriculum = Curriculum::where('public_id', $public_id)->first();

        if (!$curriculum) {
            return response()->json([
                'error' => 'Currículo não encontrado.',
            ]);
        }

        return response()->json(new CurriculumResource($curriculum), 200);

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
