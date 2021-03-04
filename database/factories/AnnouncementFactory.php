<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'content' => $this->faker->text($maxNbChars = 100),
            'price' => $this->faker->numberBetween(0, 500),
            'enabled' => true,
        ];
    }
}
