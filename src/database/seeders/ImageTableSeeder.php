<?php

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
        Image::insert([
            'path'=>2,
            'title'=>"c lang",
            'work_id'=>1
        ]);
        Image::insert([
            'path'=>3,
            'title'=>"vue.js",
            'work_id'=>1
        ]);
    }
}
