<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert([
            'name'=>'kaito',
            'email'=>"php@example.com",
            'password'=>'kaito'
        ]);
        User::insert([
            'name'=>'yodogawa',
            'email'=>"js@example.com",
            'password'=>'yodogawa'
        ]);
        User::insert([
            'name'=>'tom',
            'email'=>"tom@example.com",
            'password'=>'tom'
        ]);
    }
}
