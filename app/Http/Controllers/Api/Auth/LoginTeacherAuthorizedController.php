<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginTeacherAuthorizedController extends Controller
{
    //
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        $teacher = Teacher::where('email', $credentials['email'])->first();

        if (! $teacher) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        if ($teacher->status !== 'approved') {
            return response()->json([
                'message' => 'Sua conta ainda não foi aprovada.'
            ], 403);
        }

        if (! Auth::guard('teacher')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'teacher' => Auth::guard('teacher')->user()
        ]);
    }

}
