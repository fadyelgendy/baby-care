<?php

namespace Database\Factories\Api;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = \App\Models\User::factory()->create();

        return [
            "name" => fake()->name(),
            "age" => fake()->numberBetween(1,5),
            "gender" => "Male",
            "parent_id" => $user->getId()
        ];
    }
}