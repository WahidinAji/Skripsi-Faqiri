<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => $this->faker->numberBetween(1, 1000),
            'code' => $this->faker->bothify('##?#?'),
            'date' => $this->faker->dateTimeThisMonth,
            'price_total' => $this->faker->numberBetween(1000, 99000),
            'items_total' => $this->faker->numberBetween(1, 100),
            'user_id' => 1,
            'created_at' => $this->faker->dateTimeThisMonth,
            'updated_at' => $this->faker->dateTimeThisMonth
        ];
    }
}
