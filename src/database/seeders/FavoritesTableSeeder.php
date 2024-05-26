<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = [
            [
                'user_id' => '22',
                'store_id' => '1',
                'flag_favo' => '1',
            ],
            [
                'user_id' => '22',
                'store_id' => '3',
                'flag_favo' => '1',
            ],
        ];

        foreach ($favorites as $favorite) {
            Favorite::create($favorite);
        };
    }
}
