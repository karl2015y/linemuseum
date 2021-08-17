<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Museum;
use Illuminate\Database\Eloquent\Factories\Factory;

class MuseumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Museum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        return [
            'user_id' => $this->faker->numberBetween(11,20),
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(array ('enable','disable')) ,
            'address' => $this->faker->address(),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'buy_hundred_get_point' => $this->faker->numberBetween(1,100),
            'description' => $this->faker->text(200),
            'created_staff_id' => $this->faker->numberBetween(1,10),
            'updated_staff_id' => $this->faker->numberBetween(1,10),
        ];
    }

    public function setUserData($user_id, $user_email){
        return $this->state([
            'user_id' => $user_id,
            'email' => $user_email,
        ]);
    }

}
