<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\AlumniSkill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSkill()
    {
        $skills = Skill::latest()->get();
        $allSkills = [];
        foreach($skills as $skill){
            array_push($allSkills, $skill->Title);
        }
        return $allSkills;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createSkill(Request $request)
    {
        $skillData = $request['skills'];
        $oldSkills = Skill::get();
        foreach($skillData as $key => $value){
            $isTrue = false;
            $id = 0;
            foreach($oldSkills as $oneSkill){
                if ($oneSkill['Title'] === $value){
                    $isTrue = true;
                    $id = $oneSkill->id;
                }
            }
            if($isTrue === true){
                $alumniSkill = new AlumniSkill();
                $alumniSkill->alumni_id = $request->alumni_id;
                $alumniSkill->skill_id = $id;
                $alumniSkill->save();

            }else{
                $skill = new Skill();
                $skill->Title = $value;
                $skill->save();

                $alumniSkill = new AlumniSkill();
                $alumniSkill->alumni_id = $request['alumni_id'];
                $alumniSkill->skill_id = $skill->id;
                $alumniSkill->save();

            }
            }
            
        return response()->json(['message'=>'Skill created','data'=>$skillData],200);
    }
    
     /*
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
