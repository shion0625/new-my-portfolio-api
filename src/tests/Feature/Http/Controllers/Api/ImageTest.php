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
        $file_name = time().'.'.$file->getClientOriginalName();
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
        $this->assertDatabaseHas('images', ['path' => $file_name]);
        Storage::disk('public')->assertExists($file_name);
    }

    /**
     * @return void
     */
    public function test_update_image():void
    {
        Storage::fake('public');

        $file=UploadedFile::fake()->image('avatar.jpg');
        $file_name = time().'.'.$file->getClientOriginalName();
        $image = Image::factory()->create(['path' => $file]);

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

        $this->assertDatabaseHas('images', ['path' => $file_name]);
        $this->assertDatabaseMissing('images', ['path' => $image->path]);
        Storage::disk('public')->assertExists($file_name);
        Storage::disk('public')->assertMissing($image->path);
    }

        /**
         * @return void
         */
        public function test_destroy_image():void
        {
        $file=UploadedFile::fake()->image('avatar.jpg');
        $image = Image::factory()->create(['path' => $file]);
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
        $this->assertDatabaseMissing('images', ['path' => $image->path]);
        Storage::disk('public')->assertMissing($image->path);
    }
}
