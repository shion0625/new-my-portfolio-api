<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{

    public function test_store_image(){
        Storage::fake('public');

        $file=UploadedFile::fake()->image('avatar.jpg');
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

        $this->json('PUT', 'api/images/2', $createData)
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'image records update successfully'
        ]);
        Storage::disk('public')->assertExists($file_name);
    }


        public function test_destroy_image(){
        $this->json('DELETE', 'api/images/3')
        ->assertStatus(202)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'image records delete successfully'
        ]);
    }
}
