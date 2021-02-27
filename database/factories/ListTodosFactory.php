<?php

namespace Database\Factories;

use App\Models\ListTodos;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListTodosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListTodos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            "description" => $this->faker->sentence(8),
            "project_id" => $this->faker->numberBetween(1, 30)
        ];
    }
}
