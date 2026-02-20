<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tb_courses')->insert([
            [
                'fk_id_area' => 1,
                'public_id' => Str::uuid(),
                'fk_id_teacher' => 3,
                'title_course' => 'Desenvolvimento Web com Laravel',
                'slug_course' => 'desenvolvimento-web-laravel',
                'description_course' => 'Curso completo de desenvolvimento web utilizando Laravel, abordando autenticação, APIs e boas práticas.',
                'duration_course' => 40,
                'active_course' => true,
                'is_paid' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fk_id_area' => 1,
                'public_id' => Str::uuid(),
                'fk_id_teacher' => 3,
                'title_course' => 'React do Zero ao Avançado',
                'slug_course' => 'react-zero-avancado',
                'description_course' => 'Aprenda React com hooks, context API, consumo de APIs REST e organização de projetos.',
                'duration_course' => 35,
                'active_course' => true,
                'is_paid' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fk_id_area' => 2,
                'public_id' => Str::uuid(),
                'fk_id_teacher' => 3,
                'title_course' => 'Banco de Dados com PostgreSQL',
                'slug_course' => 'banco-dados-postgresql',
                'description_course' => 'Modelagem relacional, consultas SQL avançadas, índices e otimização de performance.',
                'duration_course' => 30,
                'active_course' => true,
                'is_paid' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fk_id_area' => 2,
                'public_id' => Str::uuid(),
                'fk_id_teacher' => 3,
                'title_course' => 'JavaScript Moderno ES6+',
                'slug_course' => 'javascript-moderno-es6',
                'description_course' => 'Conceitos modernos do JavaScript, incluindo arrow functions, promises, async/await e manipulação de DOM.',
                'duration_course' => 25,
                'active_course' => true,
                'is_paid' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fk_id_area' => 3,
                'public_id' => Str::uuid(),
                'fk_id_teacher' => 3,
                'title_course' => 'Fundamentos de UX/UI Design',
                'slug_course' => 'fundamentos-ux-ui-design',
                'description_course' => 'Princípios de experiência do usuário, prototipação, wireframes e design centrado no usuário.',
                'duration_course' => 20,
                'active_course' => true,
                'is_paid' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
