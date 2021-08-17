<?php

namespace Database\Factories;

use App\Models\KnowledgeActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnowledgeActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KnowledgeActivity::class;

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
            'museum_id' => $this->faker->numberBetween(1,10),
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(array ('enable','disable')) ,
      
            'start_at' => $start_at,
            'end_at' => $end_at,

            'point' => $this->faker->numberBetween(1,100),
            'point_cycle_hour' => $this->faker->numberBetween(1,100),
            'point_cycle_min' => $this->faker->numberBetween(1,100),
            
            'description' => $this->faker->text(200),
            'created_staff_id' => $this->faker->numberBetween(1,10),
            'updated_staff_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
