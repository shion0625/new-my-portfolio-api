<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\Image\StoreUpdateImageRequest;
use Storage;
use Illuminate\Support\Str;

class ImageApiController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateImageRequest $request)
    {
        $imageStorage = \Image::make($request->path);
        $filename = 'upload_'. date('YmdHis') .'_'. Str::random(5);
        $image_types = ['jpg', 'webp'];
        $image = new Image();
        $image->work_id = $request->work_id;
        foreach ($image_types as $image_type) {
            $upload_path = 'app/public/'. $image_type .'/'. $filename .'.'. $image_type;
            $image_path = storage_path($upload_path);
            $imageStorage->save($image_path);
            if($image_type === 'jpg'){
                $image->jpg_image = $image_type .'/'. $filename .'.'. $image_type;
            } else if($image_type === 'webp'){
                $image->webp_image = $image_type .'/'. $filename .'.'. $image_type;
            }
        }
        $image->save();
        return response()->json([
            'success' => true,
            'message' => 'image registration was successful.'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateImageRequest $request, $id)
    {
        if(Image::where('id',$id)->exists()){
            $image=Image::find($id);
            Storage::disk('public')->delete($image->jpg_image);
            Storage::disk('public')->delete($image->webp_image);
            $imageStorage = \Image::make($request->path);
            $filename = 'upload_'. date('YmdHis') .'_'. Str::random(5);
            $image_types = ['jpg', 'webp'];
            foreach ($image_types as $image_type) {
                $upload_path = 'app/public/'. $image_type .'/'. $filename .'.'. $image_type;
                $image_path = storage_path($upload_path);
                $imageStorage->save($image_path);
                if($image_type === 'jpg'){
                    $image->jpg_image = $image_type .'/'. $filename .'.'. $image_type;
                } else if($image_type === 'webp'){
                    $image->webp_image = $image_type .'/'. $filename .'.'. $image_type;
                }
            }
            $image->save();
            return response()->json([
                'success' => true,
                'message' => 'image records update successfully'
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                "message" => "image not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Image::where('id', $id)->exists()) {
            $image = Image::find($id);
            Storage::disk('public')->delete($image->jpg_image);
            Storage::disk('public')->delete($image->webp_image);
            $image->delete();
            return response()->json([
                'success' => true,
                'message' => 'image records delete successfully'
            ], 202);
        } else {
            return response()->json([
            'success' => false,
            "message" => "Image not found"
            ], 404);
        }
    }
}
