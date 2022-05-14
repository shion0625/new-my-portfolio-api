<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Skill;
use App\Models\User;


class SkillTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_index_skill():void
    {
        $this->json('GET', 'api/skills')
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
                "message" => 'succeeded in retrieving the skill list.'
            ]);
    }

    /**
     * @return void
     */
    public function test_store_skill():void
    {
        $createData =[
            'category'=>10,
            'language'=> "php,vue.js,nuxt.js",
            'experience'=>8.5,
        ];
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
            ->postJson('api/skills', $createData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'success' => true,
                'message' => 'Skill registration was successful.'
            ]);
        $this->assertDatabaseHas('skills',$createData);
    }

    /**
     * @return void
     */
    public function test_update_skill():void
    {
        $skill = Skill::factory()->create();

        $createData =[
            'category'=>3,
            'language'=> "laravel,vue.js,nuxt.js",
            'experience'=>5,
        ];

        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
            ->putJson('api/skills/'.$skill->id, $createData)
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

    /**
     * @return void
     */
    public function test_destroy_skill():void
    {
        $skill = Skill::factory()->create();
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
            ->deleteJson('api/skills/'.$skill->id)
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
