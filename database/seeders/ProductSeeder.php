<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'title' => 'iPhone 15 Pro',
            'description' => 'The ultimate iPhone with titanium design.',
        ]);

        \App\Models\Product::create([
            'title' => 'Samsung Galaxy S24 Ultra',
            'description' => 'Unleash your creativity with AI.',
        ]);

        \App\Models\Product::create([
            'title' => 'MacBook Pro M3',
            'description' => 'Mind-blowing speed and battery life.',
        ]);

        \App\Models\Product::create([
            'title' => 'Sony WH-1000XM5',
            'description' => 'Industry-leading noise canceling headphones.',
        ]);
    }
}
