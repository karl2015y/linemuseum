<?php

namespace Database\Factories;

use App\Models\VoucherWay;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherWayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VoucherWay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'voucher_id' => $this->faker->numberBetween(1,3),
            'pay_point' => $this->faker->numberBetween(1,100),
            'knowledge_point' => $this->faker->numberBetween(1,100),
            
        ];
    }
}
