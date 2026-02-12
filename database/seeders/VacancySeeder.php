<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VacancySeeder extends Seeder
{
    public function run(): void
    {
        $programacao = Area::where('name_area', 'Programação')->first();
        $design = Area::where('name_area', 'Design')->first();
        $marketing = Area::where('name_area', 'Marketing Digital')->first();
        $banco = Area::where('name_area', 'Banco de Dados')->first();
        $seguranca = Area::where('name_area', 'Segurança da Informação')->first();

        Vacancy::insert([
            [
                'public_id' => Str::uuid(),
                'fk_id_area' => $programacao->id,
                'slug_vacancy' => 'desenvolvedor-backend-laravel',
                'title_vacancy' => 'Desenvolvedor Backend Laravel',
                'description_vacancy' => 'Atuação no desenvolvimento e manutenção de APIs REST.',
                'requirements_vacancy' => 'PHP, Laravel, PostgreSQL.',
                'tasks_vacancy' => 'Desenvolver APIs e otimizar queries.',
                'status_vacancy' => true,
                'start_date_vacancy' => '2026-03-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'public_id' => Str::uuid(),
                'fk_id_area' => $design->id,
                'slug_vacancy' => 'designer-ux/ui',
                'title_vacancy' => 'Designer UX/UI',
                'description_vacancy' => 'Criação de interfaces modernas.',
                'requirements_vacancy' => 'Figma e prototipação.',
                'tasks_vacancy' => 'Criar wireframes e protótipos.',
                'status_vacancy' => true,
                'start_date_vacancy' => '2026-03-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'public_id' => Str::uuid(),
                'fk_id_area' => $marketing->id,
                'slug_vacancy' => 'analista-de-marketing-digital',
                'title_vacancy' => 'Analista de Marketing Digital',
                'description_vacancy' => 'Gestão de campanhas online.',
                'requirements_vacancy' => 'Google Ads e SEO.',
                'tasks_vacancy' => 'Criar e monitorar campanhas.',
                'status_vacancy' => true,
                'start_date_vacancy' => '2026-03-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'public_id' => Str::uuid(),
                'fk_id_area' => $banco->id,
                'slug_vacancy' => 'dba-postgresql',
                'title_vacancy' => 'DBA PostgreSQL',
                'description_vacancy' => 'Administração de banco de dados.',
                'requirements_vacancy' => 'Modelagem e performance.',
                'tasks_vacancy' => 'Gerenciar e otimizar banco.',
                'status_vacancy' => true,
                'start_date_vacancy' => '2026-04-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'public_id' => Str::uuid(),
                'fk_id_area' => $seguranca->id,
                'slug_vacancy' => 'analista-de-seguranca-da-informacao',
                'title_vacancy' => 'Analista de Segurança da Informação',
                'description_vacancy' => 'Monitoramento e prevenção de ataques.',
                'requirements_vacancy' => 'Firewall e análise de vulnerabilidades.',
                'tasks_vacancy' => 'Implementar políticas de segurança.',
                'status_vacancy' => true,
                'start_date_vacancy' => '2026-04-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
