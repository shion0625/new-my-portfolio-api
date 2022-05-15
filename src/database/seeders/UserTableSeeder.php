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
            'password'=>'kaito',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
        User::insert([
            'name'=>'yodogawa',
            'email'=>"js@example.com",
            'password'=>'yodogawa',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
        User::insert([
            'name'=>'tom',
            'email'=>"tom@example.com",
            'password'=>'tom',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
    }
}
