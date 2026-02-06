<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Resources\UserResource;
use App\Models\Plans;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterStudentController extends Controller
{

    public function __invoke(RegisterStudentRequest $request)
    {
        try {
            $data = $request->validated();

            $plan = Plans::where('slug', '=', $data['slug_plan'])->first();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'date_of_birthday' => $data['date_of_birthday'],
                'apresentation' => $data['apresentation'],
                'fk_id_plan' => $plan->id,
                'password' => Hash::make($data['password']),
            ]);

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso',
                'user' => new UserResource($user)
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Erro ao cadastrar usuário',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
