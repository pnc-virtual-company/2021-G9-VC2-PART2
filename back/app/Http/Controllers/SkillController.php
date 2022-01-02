<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSkill()
    {
        return Skill::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createSkill(Request $request)
    {
        $skill = new Skill();
        $skill->Title = $request->Title;
        $skill->save();
        return response()->json(['message'=>'Skill created','data'=>$skill],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOneSkill($id)
    {
        return Skill::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSkill(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->Title = $request->Title;
        $skill->save();
        return response()->json(['message'=>'Skill updated','data'=>$skill],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSkill($id)
    {
        return Skill::destroy($id);
    }
}
