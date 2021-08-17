<?php

namespace Database\Factories;

// use App\Models\User;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        return [
            'museum_id' =>  $this->faker->numberBetween(1,10),
            'user_id' => $this->faker->numberBetween(21,30),
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(array ('enable','disable')) ,
            'phone' => $this->faker->tollFreePhoneNumber(),
            'description' => $this->faker->text(200),
            'created_staff_id' => $this->faker->numberBetween(1,10),
            'updated_staff_id' => $this->faker->numberBetween(1,10),
        ];
    }
    public function setUserData($user_id, $user_email){
        return $this->state([
            'user_id' => $user_id,
            'phone' => explode('@',$user_email)[0],
        ]);
    }


    
}
