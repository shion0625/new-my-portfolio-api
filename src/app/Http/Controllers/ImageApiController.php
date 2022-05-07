<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $file_name = time() . '.' .$request->imgpath->getClientOriginalName();
            $img=$request->imgpath->storeAs('',$file_name,'public');
            $image = new Image();
            $image->work_id = $request->work_id;
            $image->title = $request->imgpath->getClientOriginalName();
            $image->path = $file_name;
            $image->save();
            return response()->json([
                'success' => true,
                'message' => 'Image successfully registered.',
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Image::where('id',$id)->exists()){
            $file_name = time() . '.' .$request->imgpath->getClientOriginalName();
            $img=$request->imgpath->storeAs('',$file_name,'public');
            $image = new Image();
            $image->work_id = $request->work_id;
            $image->title = $request->imgpath->getClientOriginalName();
            $image->path = $file_name;
            $image->save();
            return response()->json([
                'success' => true,
                'message' => 'Image successfully updated.',
            ], 202);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Image::where('id', $id)->exists()) {
            $image = Image::find($id);
            \Storage::disk('public')->delete($image->path);
            $image->delete();
            return response()->json([
                'success' => true,
                'message' => 'records delete successfully',
            ], 202);
        } else {
            return response()->json([
            'success' => false,
            "message" => "Image not found"
            ], 404);
        }
    }
}
