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
        $createData =[
            'category'=>3,
            'language'=> "laravel,vue.js,nuxt.js",
            'experience'=>5,
        ];
        $id=2;
        $skill = Skill::find($id);
        $old_category=$skill->category;
        $old_language=$skill->language;
        $this->json('PUT', 'api/skills/'.$id, $createData)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Skill records update successfully'
        ]);
        $this->assertDatabaseHas('skills',$createData);
        $this->assertDatabaseMissing('skills', [
            'category'=>$old_category,
            'language'=>$old_language
        ]);
    }


        public function test_destroy_skill(){
        $id=3;
        $skill = Skill::find($id);
        $old_category=$skill->category;
        $old_language=$skill->language;
        $this->json('DELETE', 'api/skills/'.$id)
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Skill records delete successfully'
        ]);
        $this->assertDatabaseMissing('skills', [
            'category'=>$old_category,
            'language'=>$old_language
        ]);
    }
}
