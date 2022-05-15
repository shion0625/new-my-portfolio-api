<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;
class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::truncate();
        Skill::insert([
            'category'=>2,
            'language'=>"c++ lang",
            'experience'=>3,
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
        Skill::insert([
            'category'=>3,
            'language'=>"vue.js nuxt laravel",
            'experience'=>1.5,
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
    }
}
