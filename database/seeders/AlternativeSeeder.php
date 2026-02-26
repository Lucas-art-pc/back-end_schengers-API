<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativeSeeder extends Seeder
{
    public function run(): void
    {
        $activities = DB::table('tb_activity')->get();

        foreach ($activities as $activity) {
            DB::table('tb_alternative')->insert([
                [
                    'title_alternative' => 'A',
                    'text_alternative' => 'Alternativa correta da atividade ' . $activity->id_activity,
                    'correct_alternative' => true,
                    'fk_id_activity' => $activity->id_activity,
                ],
                [
                    'title_alternative' => 'B',
                    'text_alternative' => 'Alternativa incorreta 1',
                    'correct_alternative' => false,
                    'fk_id_activity' => $activity->id_activity,
                ],
                [
                    'title_alternative' => 'C',
                    'text_alternative' => 'Alternativa incorreta 2',
                    'correct_alternative' => false,
                    'fk_id_activity' => $activity->id_activity,
                ],
                [
                    'title_alternative' => 'D',
                    'text_alternative' => 'Alternativa incorreta 3',
                    'correct_alternative' => false,
                    'fk_id_activity' => $activity->id_activity,
                ],
            ]);
        }
    }
}
