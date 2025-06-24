<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PerfumeCategorySeeder extends Seeder
{
    public function run()
    {
        // Main Categories
        $categories = [
            [
                'title' => 'Men\'s Perfume',
                'slug' => 'mens-perfume',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active'
            ],
            [
                'title' => 'Women\'s Perfume',
                'slug' => 'womens-perfume',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active'
            ],
            [
                'title' => 'Unisex Perfume',
                'slug' => 'unisex-perfume',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active'
            ]
        ];

        DB::table('categories')->insert($categories);

        // Get inserted categories for subcategories
        $mensId = DB::table('categories')->where('slug', 'mens-perfume')->first()->id;
        $womensId = DB::table('categories')->where('slug', 'womens-perfume')->first()->id;
        $unisexId = DB::table('categories')->where('slug', 'unisex-perfume')->first()->id;

        // Subcategories
        $subcategories = [
            // Men's subcategories
            [
                'title' => 'Eau de Parfum',
                'slug' => 'mens-eau-de-parfum',
                'is_parent' => 0,
                'parent_id' => $mensId,
                'status' => 'active'
            ],
            [
                'title' => 'Eau de Toilette',
                'slug' => 'mens-eau-de-toilette',
                'is_parent' => 0,
                'parent_id' => $mensId,
                'status' => 'active'
            ],
            [
                'title' => 'Cologne',
                'slug' => 'mens-cologne',
                'is_parent' => 0,
                'parent_id' => $mensId,
                'status' => 'active'
            ],

            // Women's subcategories
            [
                'title' => 'Eau de Parfum',
                'slug' => 'womens-eau-de-parfum',
                'is_parent' => 0,
                'parent_id' => $womensId,
                'status' => 'active'
            ],
            [
                'title' => 'Eau de Toilette',
                'slug' => 'womens-eau-de-toilette',
                'is_parent' => 0,
                'parent_id' => $womensId,
                'status' => 'active'
            ],
            [
                'title' => 'Body Mist',
                'slug' => 'womens-body-mist',
                'is_parent' => 0,
                'parent_id' => $womensId,
                'status' => 'active'
            ],

            // Unisex subcategories
            [
                'title' => 'Niche Perfumes',
                'slug' => 'niche-perfumes',
                'is_parent' => 0,
                'parent_id' => $unisexId,
                'status' => 'active'
            ],
            [
                'title' => 'Artisanal Fragrances',
                'slug' => 'artisanal-fragrances',
                'is_parent' => 0,
                'parent_id' => $unisexId,
                'status' => 'active'
            ]
        ];

        DB::table('categories')->insert($subcategories);
    }
}
