<?php

namespace Modules\Products\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\Entities\Product;
use Modules\Products\Entities\Repositories\CategoryRepository;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        
        return [

            'category' => CategoryRepository::inRandomOrder()->first()->id,
            'name' => fake()->word(5),
            'description' => fake()->realText(180)
            
        ];

    }
}
