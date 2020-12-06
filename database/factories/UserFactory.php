<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'role' => 'administrator',
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$4Wa8Y7zkHRhg6j5Fb5ywb.iXLLQAZzDpttRc5sdpAnQXrYoUnMIb6', // password
            'use_same_address' => TRUE,
            'address_1' => $this->faker->streetAddress,
            'address_2' => '',
            'city' => $this->faker->city,
            'cp' => $this->faker->postcode,
            'remember_token' => Str::random(10),

        ];
    }
}
