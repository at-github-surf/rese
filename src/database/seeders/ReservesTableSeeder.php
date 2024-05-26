<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserve;

class ReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reserves = [
            [
                'user_id' => '22',
                'store_id' => '2',
                'reserve_date' => '2024-05-20',
                'reserve_time' => '19:00:00',
                'number' => '2',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'user_id' => '22',
                'store_id' => '2',
                'reserve_date' => '2024-04-10',
                'reserve_time' => '20:00:00',
                'number' => '3',
                'visited' => '2024-04-10 19:55:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'user_id' => '22',
                'store_id' => '5',
                'reserve_date' => '2024-04-20',
                'reserve_time' => '19:00:00',
                'number' => '2',
                'visited' => '2024-04-20 18:55:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'user_id' => '23',
                'store_id' => '5',
                'reserve_date' => '2024-04-21',
                'reserve_time' => '19:00:00',
                'number' => '4',
                'visited' => '2024-04-21 18:55:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
        ];

        foreach ($reserves as $reserve) {
            Reserve::create($reserve);
        };
    }
}
