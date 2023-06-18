<?php

namespace Modules\Products\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\Repositories\UserRepository;
use Modules\Products\Entities\Categories;
use Illuminate\Support\Str;


class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Categories::class;

    public function definition(): array
    {
        
        return [

            'name' =>  fake()->randomElement([
                "outdoors",
                "indoors"
            ]),
            'description' => 'The quick brown fox jumps over the lazy dog. The quick
                        brown fox jumps over the lazy dog. The quick brown fox
                        jumps over the lazy dog. The quick brown fox jumps over
                        the lazy dog. The quick brown fox jumps over the lazy dog.
                        The quick brown fox jumps over the lazy dog. The quick
                        brown fox jumps over the lazy dog. The quick brown fox
                        jumps over the lazy dog. The quick brown fox jumps over
                        the lazy dog. The quick brown fox jumps over the lazy dog.
                        The quick brown fox jumps over the lazy dog. The quick
                        brown fox jumps over the lazy dog',
            'user' => UserRepository::inRandomOrder()->first()->user_id

        ];

    }
}
