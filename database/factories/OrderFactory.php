<?php

declare(strict_types=1);


namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
final class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => fake()->md5(),
            'total' => fake()->numberBetween(1, 100),
            'quantity' => fake()->numberBetween(1, 10),
            'status' => fake()->randomElement([
                OrderStatusEnum::CANCELLED->value,
                OrderStatusEnum::DRAFT->value,
                OrderStatusEnum::SHIPPED->value,
            ]),
        ];
    }

}
