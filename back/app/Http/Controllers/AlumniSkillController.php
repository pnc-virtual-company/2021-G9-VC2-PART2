<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniSkill;

class AlumniSkillController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skills = AlumniSkill::join('alumnis', 'alumnis.id', '=', 'alumni_skills.alumni_id')
        ->join('skills', 'skills.id', '=', 'alumni_skills.skill_id')
        ->where([['alumni_skills.alumni_id','=',$id]])
        ->orderBy('alumni_skills.id','DESC')
        ->get(['skills.*', 'alumni_skills.id']);
        return $skills;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAlumniSkill($id)
    {
        return AlumniSkill::destroy($id);
    }
}
