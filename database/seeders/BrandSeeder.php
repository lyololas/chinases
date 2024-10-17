<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Ададас',
            'slug'=>'adadas'
        ]);
        Brand::create([
            'name' => 'Бинбоус',
            'slug'=>'binbows'
        ]);
        Brand::create([
            'name' => 'Ролакс',
            'slug'=>'rolax'
        ]);
    }
}
