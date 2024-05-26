<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [ 'area' => '東京都' ],
            [ 'area' => '大阪府' ],
            [ 'area' => '福岡県' ],
        ];

        foreach ($areas as $area) {
            Area::create($area);
        };
    }
}
