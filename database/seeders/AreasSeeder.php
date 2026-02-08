<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'name_area'  => 'Programação',
                'icon_area'  => 'code',
                'color_area' => '#2563EB', // azul
            ],
            [
                'name_area'  => 'Design',
                'icon_area'  => 'palette',
                'color_area' => '#EC4899', // rosa
            ],
            [
                'name_area'  => 'Marketing Digital',
                'icon_area'  => 'megaphone',
                'color_area' => '#F59E0B', // amarelo
            ],
            [
                'name_area'  => 'Banco de Dados',
                'icon_area'  => 'database',
                'color_area' => '#10B981', // verde
            ],
            [
                'name_area'  => 'Segurança da Informação',
                'icon_area'  => 'shield-check',
                'color_area' => '#EF4444', // vermelho
            ],
        ];

        foreach ($areas as $area) {
            Area::updateOrCreate(
                ['slug_area' => Str::slug($area['name_area'])],
                [
                    'name_area'  => $area['name_area'],
                    'slug_area'  => Str::slug($area['name_area']),
                    'icon_area'  => $area['icon_area'],
                    'color_area' => $area['color_area'],
                ]
            );
        }
    }
}
