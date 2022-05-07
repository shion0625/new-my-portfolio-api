<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Image;
use App\Http\Resources\WorkResource;
use App\Http\Requests\Work\StoreWorkRequest;
use App\Http\Requests\Work\UpdateWorkRequest;
use Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_response = WorkResource::collection(Work::all());
        return response()->json([
            'success' => true,
            'message' => 'succeeded in retrieving the work list.',
            $work_response
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Work\StoreWorkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        $work = new Work;
        $work->fill($request->skillAttributes());
        $work->save();

        return response()->json([
            'success' => true,
            'message' => 'Registration was successful.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Work::where('id',$id)->exists()){
            $work = Work::find($id);
            $work_resource = new WorkResource($work);
            return response()->json([
                'success' => true,
                'message' => 'get work successfully',
                $work_resource
            ], 200);
        } else{
            return response()->json([
                'success' => false,
                "message" => "work not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Work\UpdateWorkRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkRequest $request, $id)
    {
        if(Work::where('id',$id)->exists()){
            $work = Work::find($id);
            $work->genre = null === $request->genre ? $work->genre : $request->genre;
            $work->title = null === $request->title ? $work->title : $request->title;
            $work->summary = null === $request->summary ? $work->summary : $request->summary;
            $work->period = null === $request->period ? $work->period : $request->period;
            $work->number = null === $request->number ? $work->number : $request->number;
            $work->language = null === $request->language ? $work->language : $request->language;
            $work->comment = null === $request->comment ? $work->comment : $request->comment;
            $work->url = null === $request->url ? $work->url : $request->url;
            $work->save();
            return response()->json([
                'success' => true,
                'message' => 'records update successfully',
            ], 200);
        } else{
            return response()->json([
                'success' => false,
                "message" => "work not found"
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
        if(Work::where('id', $id)->exists()) {
            $work = Work::find($id);
            $images = Image::whereWork_id($id)->select('path')->get();
            foreach($images as $image){
                Storage::disk('public')->delete($image->path);
            }
            $work->images()->delete();
            $work->delete();
            return response()->json([
                'success' => true,
                'message' => 'records delete successfully',
            ], 202);
        } else {
            return response()->json([
            'success' => false,
            "message" => "work not found"
            ], 404);
        }
    }
}
