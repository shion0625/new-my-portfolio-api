<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Image;

class ImageTest extends TestCase
{

    public function test_store_image(){
        Storage::fake('public');

        $file=UploadedFile::fake()->image('tom.jpg');
        $file_name = time().'.'.$file->getClientOriginalName();
        $createData =[
            'path'=> $file,
            'work_id'=>2,
        ];

        $this->json('POST', 'api/images', $createData)
        ->assertStatus(201)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'image registration was successful.'
        ]);
        $this->assertDatabaseHas('images', ['path' => $file_name]);
        Storage::disk('public')->assertExists($file_name);
    }

    public function test_update_image(){
        Storage::fake('public');

        $file=UploadedFile::fake()->image('avatar.jpg');
        $file_name = time().'.'.$file->getClientOriginalName();
        $image = Image::factory()->create(['path' => $file]);

        $createData =[
            'path'=> $file,
            'work_id'=>2,
        ];

        $this->json('PUT', 'api/images/'.$image->id , $createData)
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


        public function test_destroy_image(){
        $file=UploadedFile::fake()->image('avatar.jpg');
        $image = Image::factory()->create(['path' => $file]);

        $this->json('DELETE', 'api/images/'.$image->id)
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'image records delete successfully'
        ]);
        $this->assertDatabaseMissing('images', ['path' => $image->path]);
        Storage::disk('public')->assertMissing($image->path);
    }
}
