<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Skill;

class SkillTest extends TestCase
{
    public function test_index_skill(){
        $this->json('GET', 'api/skills')
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            "message" => 'succeeded in retrieving the skill list.'
        ]);
    }

    public function test_store_skill(){
        $createData =[
            'category'=>10,
            'language'=> "php,vue.js,nuxt.js",
            'experience'=>8.5,
        ];

        $this->json('POST', 'api/skills', $createData)
        ->assertStatus(201)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Skill registration was successful.'
        ]);
        $this->assertDatabaseHas('skills',$createData);
    }

    public function test_update_skill(){
        $skill = Skill::factory()->create();

        $createData =[
            'category'=>3,
            'language'=> "laravel,vue.js,nuxt.js",
            'experience'=>5,
        ];

        $this->json('PUT', 'api/skills/'.$skill->id, $createData)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Skill records update successfully'
        ]);
        $this->assertDatabaseHas('skills',$createData);
        $this->assertDatabaseMissing('skills', [
            'category'=>$skill->category,
            'language'=>$skill->language
        ]);
    }


    public function test_destroy_skill(){
        $skill = Skill::factory()->create();

        $this->json('DELETE', 'api/skills/'.$skill->id)
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Skill records delete successfully'
        ]);
        $this->assertDatabaseMissing('skills', [
            'category'=>$skill->category,
            'language'=>$skill->language
        ]);
    }
}
