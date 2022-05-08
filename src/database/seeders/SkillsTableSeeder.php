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
        Skill::insert([
            'category'=>2,
            'language'=>"c lang",
            'experience'=>3
        ]);
        Skill::insert([
            'category'=>3,
            'language'=>"vue.js",
            'experience'=>1.5
        ]);
    }
}
