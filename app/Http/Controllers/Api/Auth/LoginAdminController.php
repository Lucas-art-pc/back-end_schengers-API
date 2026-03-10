<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    //

    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = Teacher::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Você não é autorizado a acessar este recurso.',
                'status' => 403
            ], 403);
        }

        if (!Auth::guard('teacher')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $teacher = Auth::guard('teacher')->user();

        // gerar token
        $token = $teacher->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'teacher' => $teacher,
            'token' => $token,
            'status' => 200
        ], 200);
    }

}
