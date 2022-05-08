<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkTest extends TestCase
{

    public function test_index_work(){
        $this->json('GET', 'api/works')
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'succeeded in retrieving the work list.'
        ]);
    }

    public function test_store_work(){
        $createData =[
            'genre'=>10,
            'title'=>"success",
            'summary'=>"success primary",
            'period'=>2,
            'number'=>1,
            'language'=> "php,vue.js,nuxt.js",
            'comment'=>"it's success",
            'url'=> "https://qiita.com/ucan-lab/items/42c1814d8bd69895374c"
        ];

        $this->json('POST', 'api/works', $createData)
        ->assertStatus(201)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Work registration was successful.'
        ]);
    }

    public function test_show_work(){
        $this->json('GET', 'api/works/1')
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'get work successfully'
        ]);
    }

    public function test_update_work(){
        $createData =[
            'genre'=>12,
            'title'=>"update",
            'summary'=>"update primary",
            'period'=>2,
            'number'=>1,
            'language'=> "php,vue.js,nuxt.js",
            'comment'=>"it's update",
            'url'=> "https://readouble.com/laravel/8.x/ja/validation.html"
        ];
        $this->json('PUT', 'api/works/2', $createData)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'work records update successfully'
        ]);
    }


        public function test_destroy_work(){
        $this->json('DELETE', 'api/works/3')
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'work records delete successfully'
        ]);
    }
}
