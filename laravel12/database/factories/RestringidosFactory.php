<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restringidos;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restringidos>
 */
class RestringidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     
    protected $model = Restringidos::class;
     
    public function definition(): array
    {
        return [
            'identificacion' => fake()->unique()->randomNumber(7),
            'name' => fake()->name(),
            'date' => fake()->date(),
            'direction' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'description' => fake()->sentence(),
        ];
    }
    
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
