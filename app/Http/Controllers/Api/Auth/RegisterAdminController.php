<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTeacherRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;


class RegisterAdminController extends Controller
{
    //

    public function __invoke(RegisterTeacherRequest $request)
    {
        try {

        $data = $request->validated();
        $admin = Teacher::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'role' => 'admin',
            'status' => 'approved',
            'apresentation' => $data['apresentation'],
            'password' => Hash::make($data['password'])
        ]);

        return response()->json([
            'admin' => $admin,
            'message' => 'Cadastrado com sucesso!'
        ]);

        }catch (\Exception $exception){
            return response()->json([
                'message' => 'Erro ao cadastrar Administrador',
                'error' => $exception->getMessage(),
                'status' => 400
            ]);
        }
    }
}
