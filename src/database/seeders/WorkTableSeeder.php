<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Work;

class WorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::truncate();
        Work::insert([
            'genre'=>"webアプリケーション",
            'title'=>"title",
            'summary'=>"twitterと少しのslackを合わせたものを作成しまいた。
            自分が学んできたものでどの程度のものが作成できるのか知りたかったからです。
            ここで学んだことを活かしたいです。twitterと少しのslackを合わせたものを作成しまいた。
            自分が学んできたものでどの程度のものが作成できるのか知りたかったからです。
            ここで学んだことを活かしたいです。",
            'period'=>2,
            'number'=>1,
            'language'=> "php,javascript/nuxt.laravel vue",
            'comment'=>"it's hard",
            'url'=> "https://qiita.com/ucan-lab/items/42c1814d8bd69895374c",
            'source_code_url'=>'https://github.com/shion0625/new-my-portfolio-api',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
        Work::insert([
            'genre'=>"webアプリケーション",
            'title'=>"genre 2",
            'summary'=>"少し前まで生のPHPを
            使用して作成していたのでLaravelの",
            'period'=>20,
            'number'=>10,
            'language'=> "php,javascript,typescript",
            'comment'=>"it's easy",
            'url'=> "https://www.deepl.com/translator#ja/en/%E7%99%BB%E9%8C%B2%E3%81%8C%E6%88%90%E5%8A%9F%E3%81%97%E3%81%BE%E3%81%97%E3%81%9F%E3%80%82",
            'source_code_url'=>'https://github.com/shion0625',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
        Work::insert([
            'genre'=>"webアプリケーション",
            'title'=>"title",
            'summary'=>"summary",
            'period'=>2,
            'number'=>1,
            'language'=> "php,js,nuxt",
            'comment'=>"it's hard",
            'url'=> "https://qiita.com/ucan-lab/items/42c1814d8bd69895374c",
            'source_code_url'=>'https://github.com/shion0625',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
        Work::insert([
            'genre'=>"webアプリケーション",
            'title'=>"genre 2",
            'summary'=>"web application",
            'period'=>20,
            'number'=>10,
            'language'=> "php,javascript,typescript",
            'comment'=>"it's easy",
            'url'=> "https://www.deepl.com/translator#ja/en/%E7%99%BB%E9%8C%B2%E3%81%8C%E6%88%90%E5%8A%9F%E3%81%97%E3%81%BE%E3%81%97%E3%81%9F%E3%80%82",
            'source_code_url'=>'https://github.com/shion0625/new-my-portfolio-api',
            'created_at'=> '2022-05-14 15:52:39',
            'updated_at'=> '2022-05-14 15:52:39',
        ]);
    }
}
