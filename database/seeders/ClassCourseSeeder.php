<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ClassCourse;

class ClassCourseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $title = "Aula {$i} - Fundamentos do Desenvolvimento";

            ClassCourse::create([
                'id_class' => $i,
                'title_class' => $title,
                'public_id' => Str::uuid(),
                'slug_class' => Str::slug($title),
                'description_class' => "Descrição da aula {$i}. Conteúdo introdutório sobre desenvolvimento web.",
                'explication_class' => "Explicação detalhada da aula {$i}, abordando conceitos técnicos e exemplos práticos.",
                'duration_class' => rand(10, 40),
                'url_class' => "https://meusite.com/aula{$i}",
                'fk_id_course' => 1
            ]);
        }
    }
}
