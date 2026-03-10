<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginStudentController extends Controller
{

    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::guard('web')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $teacher = Auth::guard('web')->user();


        $token = $teacher->createToken('auth_token_user')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'token' => $token,
            'status' => 200
        ], 200);
    }
    //

}
