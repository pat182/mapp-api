<?php

namespace Modules\User\Database\factories;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        return [

            'user_id' => bin2hex(random_bytes(16)),
            'username' => fake()->username(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 2,
            'password' => bcrypt('test123!@#'), // password
            'remember_token' => Null,
        ];
    }
}
