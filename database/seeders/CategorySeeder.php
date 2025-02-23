<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Large Outdoor Signage',
                'slug' => 'Large Outdoor Signage',
                'status' => 'active',
            ],
            [
                'name' => 'Midium Outdoor Signage',
                'slug' => 'Midium Outdoor Signage',               
                'status' => 'active',
            ],
            [
                'name' => 'Small Outdoor Signage',
                'slug' => 'Small Outdoor Signage',
                'status' => 'active',
            ],
            [
                'name' => 'Banner Signage',
                'slug' => 'Banner Signage',
                'status' => 'active',
            ]
        ]);
    }
}
