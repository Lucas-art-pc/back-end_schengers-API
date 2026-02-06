<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class LoginStudentController extends Controller
{
    //
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();


        $user = User::where('email', $credentials['email'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }


        $token = $user->createToken('student-token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'student' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ])->cookie(
            'student_token',   // nome do cookie
            $token,
            60 * 48,           // 2 dias
            '/',
            null,
            true,              // Secure (HTTPS)
            true,              // HttpOnly
            false,
            'Strict'           // SameSite
        );
    }
}
