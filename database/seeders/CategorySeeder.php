<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics' => 'Consumer electronics, devices, and gadgets',
            'Clothing' => 'Fashion apparel and accessories',
            'Furniture' => 'Home and office furniture',
            'Books' => 'Books, e-books, and publications',
            'Sports' => 'Sports equipment and accessories',
            'Toys' => 'Toys and games for all ages',
            'Beauty' => 'Beauty and personal care products',
            'Food' => 'Food and grocery items',
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
            ]);
        }
    }
}
