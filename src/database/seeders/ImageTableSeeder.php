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
            'jpg_image'=>'jpg/upload_20220514155226_O1e7d.jpg',
            'webp_image'=>'webp/upload_20220514155226_O1e7d.webp ',
            'work_id'=>1,
            'created_at'=> '2022-05-14 15:52:27',
            'updated_at'=> '2022-05-14 15:52:27',
        ]);
        Image::insert([
            'jpg_image'=>'jpg/upload_20220514155239_cgS4I.jpg',
            'webp_image'=>'webp/upload_20220514155239_cgS4I.webp',
            'work_id'=>1,
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
    }
}
