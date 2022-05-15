<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Image;
use App\Models\User;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_store_image():void
    {
        Storage::fake('public');
        $file=UploadedFile::fake()->image('tom.jpg');
        $createData =[
            'path'=> $file,
            'work_id'=>2,
        ];

        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
            ->postJson('api/images', $createData)
            ->assertStatus(201)
            ->assertJsonFragment([
                'success' => true,
                'message' => 'image registration was successful.'
            ]);
        if(Image::where('id',1)->exists()){
            $image = Image::find(1);
            $this->assertDatabaseHas('images', ['jpg_image' => $image->jpg_image]);
            $this->assertDatabaseHas('images', ['webp_image' => $image->webp_image]);
        }
    }

    /**
     * @return void
     */
    public function test_update_image():void
    {
        Storage::fake('public');

        $file=UploadedFile::fake()->image('avatar.jpg');
        $image = Image::factory()->create();

        $createData =[
            'path'=> $file,
            'work_id'=>2,
        ];
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
            ->putJson('api/images/'.$image->id , $createData)
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
                'message' => 'image records update successfully',
            ]);

        if(Image::where('id',1)->exists()){
            $imageFind = Image::find(1);
            $this->assertDatabaseHas('images', ['jpg_image' => $imageFind->jpg_image]);
            $this->assertDatabaseHas('images', ['webp_image' => $imageFind->webp_image]);
        }
        $this->assertDatabaseMissing('images', ['jpg_image' => $image->jpg_image]);
        $this->assertDatabaseMissing('images', ['webp_image' => $image->webp_image]);
    }

        /**
         * @return void
         */
        public function test_destroy_image():void
        {
        $image = Image::factory()->create();
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->actingAs($user)
            ->deleteJson('api/images/'.$image->id)
            ->assertStatus(202)
            ->assertJsonFragment([
                'success' => true,
                'message' => 'image records delete successfully'
            ]);
        $this->assertDatabaseMissing('images', ['jpg_image' => $image->jpg_image]);
    }
}
