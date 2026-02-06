<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTeacherRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class RegisterTeacherController extends Controller
{
    //

    public function __invoke(RegisterTeacherRequest $request)
    {
        try {
            $data = $request->validated();

            $teacher = Teacher::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'role' => 'teacher',
                'status' => 'pending',
                'apresentation' => $data['apresentation'],
                'password' => Hash::make($data['password']),
            ]);

            return response()->json([
                'teacher' => $teacher,
                'message' => 'Cadastrado com sucesso!'
            ]);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Erro ao cadastrar!'
            ]);
        }

    }
}
