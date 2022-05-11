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

        $createData =[
            'path'=> $file,
            'work_id'=>2,
        ];
        $id = 2;
        $image=Image::find($id);
        $old_file_name = $image->path;

        $this->json('PUT', 'api/images/'.$id , $createData)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'image records update successfully'
        ]);

        $this->assertDatabaseHas('images', ['path' => $file_name]);
        $this->assertDatabaseMissing('images', ['path' => $old_file_name]);
        Storage::disk('public')->assertExists($file_name);
        Storage::disk('public')->assertMissing($old_file_name);
    }


        public function test_destroy_image(){
        $id = 1;
        $image=Image::find($id);
        $old_file_name = $image->path;
        $this->json('DELETE', 'api/images/'.$id)
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'image records delete successfully'
        ]);
        $this->assertDatabaseMissing('images', ['path' => $old_file_name]);
        Storage::disk('public')->assertMissing($old_file_name);
    }
}
