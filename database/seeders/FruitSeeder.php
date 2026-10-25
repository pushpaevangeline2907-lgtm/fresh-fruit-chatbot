<?php

namespace Database\Seeders;

use App\Models\Fruit;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    public function run(): void
    {
        $fruits = [
            ['fruit_name' => 'Banana',       'price_per_kg' => 100],
            ['fruit_name' => 'Orange',       'price_per_kg' => 120],
            ['fruit_name' => 'Mango',        'price_per_kg' => 150],
            ['fruit_name' => 'Grapes',       'price_per_kg' => 140],
            ['fruit_name' => 'Watermelon',   'price_per_kg' => 40],
            ['fruit_name' => 'Pineapple',    'price_per_kg' => 80],
            ['fruit_name' => 'Guava',        'price_per_kg' => 90],
            ['fruit_name' => 'Papaya',       'price_per_kg' => 70],
            ['fruit_name' => 'Pomegranate',  'price_per_kg' => 200],
            ['fruit_name' => 'Pear',         'price_per_kg' => 180],
            ['fruit_name' => 'Lemon',        'price_per_kg' => 100],
            ['fruit_name' => 'Kiwi',         'price_per_kg' => 350],
            ['fruit_name' => 'Strawberry',   'price_per_kg' => 300],
            ['fruit_name' => 'Sapota',       'price_per_kg' => 100],
            ['fruit_name' => 'Dragon Fruit', 'price_per_kg' => 250],
            ['fruit_name' => 'Apple',        'price_per_kg' => 200],
        ];

        foreach ($fruits as $fruit) {
            Fruit::create($fruit);
        }
    }
}
