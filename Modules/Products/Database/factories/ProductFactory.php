<?php

namespace Modules\Products\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\Entities\Product;
use Modules\Products\Entities\Repositories\CategoryRepository;
use Modules\User\Entities\Repositories\UserRepository;
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
            "user" => UserRepository::inRandomOrder()->first()->user_id,
            'category' => CategoryRepository::inRandomOrder()->first()->id,
            'name' => fake()->word(5),
            'description' => fake()->realText(180)

        ];

    }
}
