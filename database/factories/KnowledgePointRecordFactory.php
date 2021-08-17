<?php

namespace Database\Factories;

use App\Models\KnowledgePointRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnowledgePointRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KnowledgePointRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'knowledge_activity_id' => $this->faker->numberBetween(1,10),
            'knowledge_activity_name' => $this->faker->name(),
            'member_id' => $this->faker->numberBetween(1,10),
            'member_name' => $this->faker->name(),
            'point' => $this->faker->numberBetween(5,150),
        ];
    }
}
