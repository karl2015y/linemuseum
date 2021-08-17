<?php

namespace Database\Factories;

use App\Models\PayPointRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPointRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayPointRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->numberBetween(1,10),
            'shop_name' => $this->faker->name(),
            'member_id' => $this->faker->numberBetween(1,10),
            'member_name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(500,3500),
            'point' => $this->faker->numberBetween(5,150),
        ];
    }
}
