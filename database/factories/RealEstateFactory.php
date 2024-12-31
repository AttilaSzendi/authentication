<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RealEstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "address" => $this->faker->streetAddress,
            "city" => $this->faker->city,
            "country" => $this->faker->country,
            "photo" => $this->faker->imageUrl(360, 360, 'building'),
            "availableUnits" => rand(1, 100),
            "wifi" => $this->faker->boolean,
            "laundry" => $this->faker->boolean,
        ];
    }
}
