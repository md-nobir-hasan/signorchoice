<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PerfumeBrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['title' => 'Chanel', 'slug' => 'chanel'],
            ['title' => 'Dior', 'slug' => 'dior'],
            ['title' => 'Gucci', 'slug' => 'gucci'],
            ['title' => 'Tom Ford', 'slug' => 'tom-ford'],
            ['title' => 'Versace', 'slug' => 'versace'],
            ['title' => 'Calvin Klein', 'slug' => 'calvin-klein'],
            ['title' => 'Hugo Boss', 'slug' => 'hugo-boss'],
            ['title' => 'Dolce & Gabbana', 'slug' => 'dolce-gabbana'],
            ['title' => 'Yves Saint Laurent', 'slug' => 'yves-saint-laurent'],
            ['title' => 'Armani', 'slug' => 'armani'],
            ['title' => 'Burberry', 'slug' => 'burberry'],
            ['title' => 'Prada', 'slug' => 'prada'],
            ['title' => 'Bvlgari', 'slug' => 'bvlgari'],
            ['title' => 'Jo Malone', 'slug' => 'jo-malone'],
            ['title' => 'Creed', 'slug' => 'creed']
        ];

        DB::table('brands')->insert($brands);
    }
}
