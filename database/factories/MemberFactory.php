<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(31,40),
            'gender' => $this->faker->randomElement(array ('male','female')) ,
            'year' => strval($this->faker->numberBetween(1980,2000)),
            'month' => $this->faker->randomElement(array ("01", "02", "03", "04", "05", "06", "07", "08", "09", "10" ,"11", "12")) ,
            'name' => $this->faker->name(),
            'address_region' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'recommend_museum' => $this->faker->name(),
            'pay_point' => $this->faker->numberBetween(1,200),
            'knowledge_point' => $this->faker->numberBetween(1,200),
        ];
    }

    public function setUserData($user_id, $user_email){
        return $this->state([
            'user_id' => $user_id,
            'email' => $user_email,
        ]);
    }
}
