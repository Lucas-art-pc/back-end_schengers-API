<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTeacherRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class RegisterTeacherController extends Controller
{
    //


    public function __invoke(RegisterTeacherRequest $request): JsonResponse
    {
        try {

            $data = $request->validated();


            $teacher = DB::transaction(function () use ($data) {
                return Teacher::create([
                    'name'         => $data['name'],
                    'email'        => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'role'         => 'teacher',
                    'status'       => 'pending',
                    'apresentation'=> $data['apresentation'],
                    'password'     => Hash::make($data['password']),
                ]);
            });

            Auth::login($teacher);
            $request->session()->regenerate();

            return response()->json([
                'teacher' => $teacher,
                'message' => 'Cadastrado com sucesso!'
            ], 201);

        } catch (\Exception $e) {

            Log::error("Teacher Registration Failed: " . $e->getMessage());

            return response()->json([
                'message' => 'Erro ao cadastrar! Tente novamente mais tarde.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
