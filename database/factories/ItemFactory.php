<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title,
            'code' => $this->faker->bothify('##?#?'),
            'price' => $this->faker->numberBetween(1000, 99000),
            'type' => $this->faker->randomElement(['box', 'unit']),
            'stock' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->dateTimeThisMonth,
            'updated_at' => $this->faker->dateTimeThisMonth
        ];
    }
}
