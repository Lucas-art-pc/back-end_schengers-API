<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyRequest;
use App\Http\Resources\VacancyResource;
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
        $vacancies = Vacancy::where('status_vacancy', true)->with('area')->get();

        if ($vacancies->count() === 0) {
            return response()->json([
                'message' => 'Nossa equipe está cheia no momento...',
            ]);
        }

        return response()->json(
            VacancyResource::collection($vacancies),
            200
        );
    }


    public function adminIndex()
    {
        try {
            $vacancies = Vacancy::with('area')->get();

            if ($vacancies->count() === 0) {
                return response()->json([
                    'message' => 'Nenhuma vaga cadastrada.',
                ]);
            }

            return response()->json(VacancyResource::collection($vacancies)) ;

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(VacancyRequest $request)
    {
        try {
            $data = $request->validated();

            $area = Area::where('slug_area', $data['slug_area'])->first();

            Vacancy::create([
                'fk_id_area' => $area->id,
                'title_vacancy' => $data['title_vacancy'],
                'description_vacancy' => $data['description_vacancy'],
                'requirements_vacancy' => $data['requirements_vacancy'],
                'tasks_vacancy' => $data['tasks_vacancy'],
                'status_vacancy' => $data['status_vacancy'],
                'start_date_vacancy' => $data['start_date_vacancy'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vaga adicionada com sucesso!'
            ]);

        }catch (\Exception $e){
            return response()->json([
                'message' => 'Não foi possível adicionar esta vaga!',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function show(string $public_id, string $slug_vacancy)
    {

        try {
            $vacancy = Vacancy::with('area')
                ->where('public_id', $public_id)
                ->firstOrFail();


            if ($vacancy->slug_vacancy !== $slug_vacancy) {
                return response()->json([
                    'message' => 'Não encontramos essa vaga...'
                ], 404);
            }

            return response()->json(new VacancyResource($vacancy));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Vaga não encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $public_id)
    {
        try{


            $data = $request->all();

            $vacancy = Vacancy::where('public_id', $public_id)->firstOrFail();

            $vacancy->update($data);

            return response()->json([
                'message' => 'Vaga atualizada com sucesso!',
                'data' => $vacancy
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
                'message' => "Erro ao atualizar vaga!",

            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $public_id)
    {
        try {
            $vacancy = Vacancy::where('public_id', $public_id)->firstOrFail();

            $vacancy->delete();

            return response()->json([
                'message' => 'Vaga excluída com sucesso'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Vaga não encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao excluir esta vaga!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
