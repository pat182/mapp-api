<?php

namespace Modules\User\Database\factories;

use Modules\User\Entities\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserProfile::class;

    public function definition(): array
    {
        return [
            
            'f_name' => fake()->firstName(),
            'l_name' => fake()->lastName()

        ];
    }
}
