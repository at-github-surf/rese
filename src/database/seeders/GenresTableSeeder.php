<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            [ 'genre' => '寿司' ],
            [ 'genre' => '焼肉' ],
            [ 'genre' => '居酒屋' ],
            [ 'genre' => 'イタリアン' ],
            [ 'genre' => 'ラーメン' ],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        };
    }
}
