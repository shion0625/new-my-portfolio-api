<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Work;
use App\Models\User;


class WorkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testIndexWorkSuccess():void
    {
        $this->json('GET', 'api/works')
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'succeeded in retrieving the work list.'
        ]);
    }

    /**
     * @return void
     */
    public function testStoreWorkSuccess():void
    {
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

        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
        ->postJson('api/works', $createData)
        ->assertStatus(201)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Work registration was successful.'
        ]);
        $this->assertDatabaseHas('works',$createData);
    }

    /**
     * @return void
     */
    public function testShowWorkSuccess():void
    {
        $work = Work::factory()->create();

        $this->json('GET', 'api/works/'.$work->id)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'get work successfully'
        ]);
        $this->assertDatabaseHas('works',[
            'genre'=>$work->genre,
            'title'=>$work->title,
        ]);
    }

    /**
     * @return void
     */
    public function testUpdateWorkSuccess():void
    {
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
        $work = Work::factory()->create();

        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
        ->putJson('api/works/'.$work->id, $createData)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'work records update successfully'
        ]);
        $this->assertDatabaseHas('works',$createData);
        $this->assertDatabaseMissing('works', [
            'genre'=>$work->genre,
            'title'=>$work->title
        ]);
    }

    /**
     * @return void
     */
    public function testDestroyWork():void
    {
        $work = Work::factory()->create();
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
        ->deleteJson('api/works/'.$work->id)
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'work records delete successfully'
        ]);
        $this->assertDatabaseMissing('works', [
            'genre'=>$work->genre,
            'title'=>$work->title
        ]);
    }
}
