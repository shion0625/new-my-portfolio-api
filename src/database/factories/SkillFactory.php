<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category'=>$this->faker->randomNumber(2, false),
            'language'=>$this->faker->sentence(2, true),
            'experience'=>$this->faker->randomFloat(2, 0, 50),
        ];
    }
}
