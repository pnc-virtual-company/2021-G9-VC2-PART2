<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkExperience;
use App\Models\Company;
use App\Models\Position;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllWorkExperience()
    {
        return WorkExperience::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createWorkExperience(Request $request)
    {   
         $workExperience = new WorkExperience();
         $workExperience->alumni_id = $request->alumni_id;
         
        $workExperience->company_id = $request->company_id;

        if (is_numeric($request->position_id)){
            $workExperience->position_id = $request->position_id;
        }else{
            $position = new Position();
            $position->positionName = $request->position_id;
            $position->save();
            $workExperience->position_id = $position->id;
        }
        $workExperience->start_year = $request->start_year;
        $workExperience->end_year = $request->end_year;
        $workExperience->save();
        
        return response()->json(['message'=>'Work Experience created','data'=>$workExperience],201);
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOneWorkExperience($alumniId)
    {
        $workExperiences = WorkExperience::join('companies', 'companies.id', '=', 'work_experiences.company_id')
                ->join('positions', 'positions.id', '=', 'work_experiences.position_id')
                ->join('alumnis', 'alumnis.id', '=', 'work_experiences.alumni_id')
                ->where([['work_experiences.alumni_id','=',$alumniId]])
                ->orderBy('work_experiences.id','DESC')
                ->get(['work_experiences.id','work_experiences.alumni_id','companyName','positionName','start_year','end_year']);
        return $workExperiences;
        
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWorkExperience(Request $request, $id)
    {
        $workExperience = WorkExperience::findOrFail($id);
        $workExperience->alumni_id = $request->alumni_id;
        $workExperience->company_id = $request->company_id;
        $workExperience->start_year = $request->start_year;
        $workExperience->end_year = $request->end_year;

        $company = Company::findOrFail($request->company_id);
        $company -> email = $request->email;
        $company->address = $request ->address;
        $company-> phone = $request->phone;
        $company-> domain= $request->domain;
        $company->save();

            
       if (is_numeric($request->position_id)){
           $workExperience->position_id = $request->position_id;
       }else{
           $position = new Position();
           $position->positionName = $request->position_id;
           $position->save();
           $workExperience->position_id = $position->id;
       }
       
       $workExperience->save();
       
       return response()->json(['message'=>'Work Experience updated','data'=>$workExperience],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteWorkExperience($id)
    {

        $isDelete = WorkExperience::destroy($id);
        if($isDelete){
            return response()->json(['message'=>'Work Experience deleted'],200);
        }else{
            return response()->json(['message'=>'Delete error'],404);
        }
    }
}
