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
            'genre'=>1,
            'title'=>"title",
            'summary'=>"summary",
            'period'=>2,
            'number'=>1,
            'language'=> "php,javascript,nuxt",
            'comment'=>"it's hard",
            'url'=> "https://qiita.com/ucan-lab/items/42c1814d8bd69895374c"
        ]);
        Work::insert([
            'genre'=>2,
            'title'=>"genre 2",
            'summary'=>"web application",
            'period'=>20,
            'number'=>10,
            'language'=> "php,javascript,typescript",
            'comment'=>"it's easy",
            'url'=> "https://www.deepl.com/translator#ja/en/%E7%99%BB%E9%8C%B2%E3%81%8C%E6%88%90%E5%8A%9F%E3%81%97%E3%81%BE%E3%81%97%E3%81%9F%E3%80%82"
        ]);
        Work::insert([
            'genre'=>1,
            'title'=>"title",
            'summary'=>"summary",
            'period'=>2,
            'number'=>1,
            'language'=> "php,js,nuxt",
            'comment'=>"it's hard",
            'url'=> "https://qiita.com/ucan-lab/items/42c1814d8bd69895374c"
        ]);
        Work::insert([
            'genre'=>2,
            'title'=>"genre 2",
            'summary'=>"web application",
            'period'=>20,
            'number'=>10,
            'language'=> "php,javascript,typescript",
            'comment'=>"it's easy",
            'url'=> "https://www.deepl.com/translator#ja/en/%E7%99%BB%E9%8C%B2%E3%81%8C%E6%88%90%E5%8A%9F%E3%81%97%E3%81%BE%E3%81%97%E3%81%9F%E3%80%82"
        ]);
    }
}
