<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyRequest;
use App\Models\Area;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
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
    public function store(VacancyRequest $request)
    {
        //

        try {
            $data = $request->validated();

            $area = Area::findOrFail($data['area_id']);

            Vacancy::create([
                'slug' => $data['slug_area'],
                'title_vacancy' => $data['title_vacancy'],
                'description_vacancy' => $data['description_vacancy'],
                'requirements_vacancy' => $data['requirements_vacancy'],
                'tasks_vacancy' => $data['tasks_vacancy'],
                'start_date_vacancy' => $data['start_date_vacancy'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vacancy added successfully'
            ]);

        }catch (\Exception $e){
            return response()->json([
                'message' => 'Não foi possível adicionar esta vaga!',
                'error' => $e->getMessage()
            ]);
        }

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
