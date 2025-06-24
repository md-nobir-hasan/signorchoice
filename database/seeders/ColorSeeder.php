<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            [
                'name' => 'Black',
                'code' => '#000000',
            ],
            [
                'name' => 'White',
                'code' => '#FFFFFF',
            ],
            [
                'name' => 'Silver',
                'code' => '#C0C0C0',
            ],
            [
                'name' => 'Gray',
                'code' => '#808080',
            ],
            [
                'name' => 'Red',
                'code' => '#FF0000',
            ],
            [
                'name' => 'Blue',
                'code' => '#0000FF',
            ],
            [
                'name' => 'Green',
                'code' => '#008000',
            ],
            [
                'name' => 'Gold',
                'code' => '#FFD700',
            ],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
