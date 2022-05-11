<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $file=UploadedFile::fake()->image('tom.jpg');
        $file_name = time().'.'.$file->getClientOriginalName();
        return [
            'path' =>$file_name,
            'title'=> $this->faker->title(),
            'work_id'=>$this->faker->randomDigit(),
        ];
    }
}
