<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::truncate();
        Image::insert([
            'path'=>'1651978452.109.jpeg',
            'title'=>'109.jpeg',
            'work_id'=>1
        ]);
        Image::insert([
            'path'=>'1651978498.LINE_P2019613_195329.jpg',
            'title'=>'LINE_P2019613_195329.jpg',
            'work_id'=>1
        ]);
    }
}
