<?php

namespace Database\Factories;

use App\Models\MemberUsedVoucherRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberUsedVoucherRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberUsedVoucherRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_at =  $this->faker->dateTimeBetween('-1 years', '+1 month', 'Asia/Taipei');
        $end_at =  $this->faker->dateTimeBetween($start_at, '+1 year', 'Asia/Taipei');
        return [
            'voucher_id' => $this->faker->numberBetween(1,3),
            'voucher_name' => $this->faker->name(),

            'member_id' => $this->faker->numberBetween(1,3),
            'member_name' => $this->faker->name(),

            'pay_point' => $this->faker->numberBetween(1,300),
            'knowledge_point' => $this->faker->numberBetween(1,300),

            'start_at' => $start_at,
            'end_at' => $end_at,

            'description' => $this->faker->text(200),
            'pic_1' => '/storage/vouchers/1/pic1.jpg',
            'pic_2' => '/storage/vouchers/1/pic2.jpg',
        ];
    }
}
