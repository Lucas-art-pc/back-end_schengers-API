<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginTeacherController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::guard('teacher')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $teacher = Auth::guard('teacher')->user();

        // gerar token
        $token = $teacher->createToken('auth_token_teacher')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'teacher' => $teacher,
            'token' => $token,
            'status' => 200
        ], 200);
    }
}
