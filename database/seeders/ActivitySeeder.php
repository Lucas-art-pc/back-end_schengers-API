<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tb_activity')->insert([
            [
                'title_activity' => 'Introdução ao Curso',
                'public_id' => Str::uuid(),
                'slug_activity' => 'introducao-ao-curso',
                'description_activity' => 'Atividade inicial para apresentar o curso ao aluno.',
                'question_activity' => 'Qual é o principal objetivo deste curso?',
                'fk_id_course' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_activity' => 'Fundamentos Teóricos',
                'public_id' => Str::uuid(),
                'slug_activity' => 'fundamentos-teoricos',
                'description_activity' => 'Revisão dos conceitos teóricos fundamentais.',
                'question_activity' => 'Explique os principais conceitos abordados nesta aula.',
                'fk_id_course' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_activity' => 'Exercício Prático',
                'public_id' => Str::uuid(),
                'slug_activity' => 'exercicio-pratico',
                'description_activity' => 'Aplicação prática dos conceitos estudados.',
                'question_activity' => 'Descreva como você aplicaria esse conceito em um projeto real.',
                'fk_id_course' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_activity' => 'Estudo de Caso',
                'public_id' => Str::uuid(),
                'slug_activity' => 'estudo-de-caso',
                'description_activity' => 'Análise de um cenário real relacionado ao conteúdo.',
                'question_activity' => 'Qual solução você adotaria para o problema apresentado?',
                'fk_id_course' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_activity' => 'Avaliação Final',
                'public_id' => Str::uuid(),
                'slug_activity' => 'avaliacao-final',
                'description_activity' => 'Avaliação dos conhecimentos adquiridos ao longo do curso.',
                'question_activity' => 'O que você aprendeu ao concluir este curso?',
                'fk_id_course' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
