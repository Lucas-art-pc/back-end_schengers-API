<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Persons extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::updateOrCreate([
            'id' => 1,
            'name' => 'Lucas Medina',
            'email' => 'lmbosso2008@gmail.com',
            'phone_number' => '123456789',
            'date_of_birthday' => '2008-07-17',
            'apresentation' => 'Usuário interessado em cursos de tecnologia e programação.',
            'fk_id_plan' => 2,
            'password' => Hash::make('senha1234'),
        ]);

        Teacher::updateOrCreate([
            'id' => 1,
            'name' => 'Cassia Medina',
            'email' => 'cassiacanta@gmail.com',
            'phone_number' => '123456789',
            'role' => 'teacher',
            'status' => 'pending',
            'apresentation' => 'Usuário interessado em cursos de tecnologia e programação.',
            'password' => Hash::make('senha1234'),
            ]
        );

        Teacher::updateOrCreate([
            'id' => 2,
            'name' => 'Gilmar Bosso',
            'email' => 'mazinhobosso@gmail.com',
            'phone_number' => '1234567810',
            'role' => 'admin',
            'status' => 'approved',
            'apresentation' => 'Usuário interessado em cursos de tecnologia e programação.',
            'password' => Hash::make('senha1234'),
        ]);
    }
}
