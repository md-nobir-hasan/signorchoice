<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfumeDisplaySizeSeeder extends Seeder
{
    public function run()
    {
        $display_sizes = [
            ['size' => '30 ML'],
            ['size' => '50 ML'],
            ['size' => '75 ML'],
            ['size' => '100 ML'],
            ['size' => '125 ML'],
            ['size' => '200 ML'],
            // Ounce sizes
            ['size' => '1.0 oz'],
            ['size' => '1.7 oz'],
            ['size' => '2.5 oz'],
            ['size' => '3.4 oz'],
            ['size' => '4.2 oz'],
            // Travel sizes
            ['size' => '5 ML'],
            ['size' => '10 ML'],
            ['size' => '15 ML'],
            // Body mist sizes
            ['size' => '236 ML'],
            ['size' => '250 ML']
        ];

        DB::table('display_sizes')->insert($display_sizes);
    }
}
