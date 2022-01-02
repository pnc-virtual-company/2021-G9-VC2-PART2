<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Http\Resources\AlumniResource;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAlumni()
    {
        return AlumniResource::collection(Alumni::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAlumni(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOneAlumni($id)
    {
        return new AlumniResource(Alumni::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAlumni(Request $request, $id)
    {
        $request->validate([
            'phone_number'=>'required',
            'gender'=>'nullable',
            'batch'=>'nullable',
            'major'=>'nullable',
        ]);
        $alumni = Alumni::findOrFail($id);
        $alumni->phone_number = $request->phone_number;
        $alumni->gender = $request->gender;
        $alumni->batch = $request->batch;
        $alumni->major = $request->major;
        $alumni->status = $request->status;
        $alumni->user_id = $request->user_id;

        $alumni->save();
        return response()->json(['message'=> 'Alumni Updated', 'data'=>$alumni], 201);
    }

    public function updateAlumniPrifile(Request $request, $id){
        $request->validate([
            'profile'=>'image|mimes:jpg,png,jpeg,gif|max:19999',
        ]);
        $request->file('profile')->store('public/profiles');

        $profile = Alumni::findOrFail($id);
        $profile->profile = $request->file('profile')->hashName();

        $profile->save();
        return response()->json(['message'=> 'Profile Updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAlumni($id)
    {
        // $alumni = Alumni::find($id);
        // $destination = 'storage/profiles/'.$alumni->profile;
        // if(file::exists($destination))
        // {
        //     file::delete($destination);
        // }
        // return Alumni::destroy($id);
    }
}
