<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

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
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(array ('enable','disable')) ,
      
            'start_at' => $start_at,
            'end_at' => $end_at,

            'amount' => $this->faker->numberBetween(1,100),
            'description' => $this->faker->text(200),

            'pic_1' => '/storage/vouchers/1/pic1.jpg',
            'pic_2' => '/storage/vouchers/1/pic2.jpg',
            
            'created_staff_id' => $this->faker->numberBetween(1,10),
            'updated_staff_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
