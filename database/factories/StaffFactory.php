<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        return [
            'user_id' => $this->faker->numberBetween(2,10),
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(array ('enable','disable')) ,
            'email' => $this->faker->unique()->safeEmail(),
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
