<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\Image\StoreUpdateImageRequest;
use Storage;

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
        if(null === $request->path){
            return response()->json([
                'success' => false,
                'message' => 'Image cannot find',
            ], 404);
        }
            $file_name = time() . '.' .$request->path->getClientOriginalName();
            $request->path->storeAs('',$file_name,'public');

            $image = new Image();
            $image->work_id = $request->work_id;
            $image->title = $request->path->getClientOriginalName();
            $image->path = $file_name;
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
        if(null === $request->path){
            return response()->json([
                'success' => false,
                'message' => 'Image cannot find',
            ], 404);
        }
        if(Image::where('id',$id)->exists()){
            $file_name = time() . '.' .$request->path->getClientOriginalName();
            $request->path->storeAs('',$file_name,'public');
            $image = new Image();
            $image->work_id = $request->work_id;
            $image->title = $request->path->getClientOriginalName();
            $image->path = $file_name;
            $image->save();
            return response()->json([
                'success' => true,
                'message' => 'image records update successfully'
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                "message" => "skill not found"
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
            Storage::disk('public')->delete($image->path);
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
