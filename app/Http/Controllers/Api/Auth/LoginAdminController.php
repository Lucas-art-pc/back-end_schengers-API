<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    //

    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();


        $user = Teacher::where('email', $credentials['email'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        if ($user->role != 'admin') {
            return response()->json([
               'message' => 'Você não é autorizado a acessar este recurso.',
               'code' => 401
            ]);
        }


        $token = $user->createToken('teacher-token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'student' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ])->cookie(
            'teacher_token',
            $token,
            60 * 24,
            '/',
            null,
            true,              // Secure (HTTPS)
            true,              // HttpOnly
            false,
            'Strict'           // SameSite
        );
    }
}
