<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluations = [
            [
                'user_id' => '22',
                'store_id' => '5',
                'stars' => '3',
                'ev_detail' => '普通でした',
                'created_at' => '2024-04-22 10:00:00',
                'updated_at' => '2024-04-22 10:00:00',
            ],
            [
                'user_id' => '23',
                'store_id' => '5',
                'stars' => '4',
                'ev_detail' => 'とてもよかったです',
                'created_at' => '2024-04-22 10:00:00',
                'updated_at' => '2024-04-22 10:00:00',
            ],
        ];

        foreach ($evaluations as $evaluation) {
            Evaluation::create($evaluation);
        };
    }
}
