<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'genre'=>$this->faker->title(),
            'title'=>$this->faker->title(),
            'summary'=>$this->faker->sentence(6, true),
            'period'=>$this->faker->randomNumber(3,false),
            'number'=>$this->faker->randomNumber(2, false),
            'language'=>$this->faker->sentence(2, true),
            'comment'=>$this->faker->sentence(6, true),
            'url'=>$this->faker->url(),
            'source_code_url'=>$this->faker->url(),
        ];
    }
}
