<?php

namespace Database\Factories;

use App\Models\VoucherRecordStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherRecordStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VoucherRecordStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'voucher_record_id' =>  $this->faker->numberBetween(1,10),
            'status' => $this->faker->randomElement(array ('unused','used', 'pass')) ,
        ];
    }
}
