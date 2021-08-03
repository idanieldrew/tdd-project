<?php

namespace Database\Factories;

use App\Models\Totourial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TotourialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Totourial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'user_id' => function(){
                return User::factory()->create()->id;
            },
        ];
    }
}
