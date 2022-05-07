<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
use App\Http\Requests\Skill\CreateSkillRequest;
use App\Http\Requests\Skill\UpdateSkillRequest;


class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skill_response = SkillResource::collection(Skill::orderBy('category', 'asc')->get());

        return response()->json([
            'success' => true,
            'message' => 'succeeded in retrieving the skill list.',
            $skill_response
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSkillRequest $request)
    {
        $skill = new Skill;
        $skill->fill($request->skillAttributes());
        $skill->save();

        return response()->json([
            'success' => true,
            'message' => 'Registration was successful.'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkillRequest $request, $id)
    {
        if(Skill::where('id',$id)->exists()){
            $skill = Skill::find($id);
            $skill->category = is_null($request->category) ? $skill->category : $request->category;
            $skill->language = is_null($request->language) ? $skill->language : $request->language;
            $skill->experience = is_null($request->experience) ? $skill->experience : $request->experience;
            $skill->save();
        return response()->json([
                'success' => true,
                'message' => 'records update successfully',
            ], 200);
        } else{
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
        if(Skill::where('id', $id)->exists()) {
            $skill = Skill::find($id);
            $skill->delete();
            return response()->json([
                'success' => true,
                'message' => 'records delete successfully',
            ], 202);
        } else {
            return response()->json([
            'success' => false,
            "message" => "skill not found"
            ], 404);
        }
    }
}
