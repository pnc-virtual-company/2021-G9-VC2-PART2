<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPosition()
    {
        return Position::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPosition(Request $request)
    {
        $position = new Position();
        $position->positionName = $request->positionName;
        $position->save();
        return response()->json(['message'=>'Position created','data'=>$position],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOnePosition($id)
    {
        return Position::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request, $id)
    {
        $position = Position::findOrFail($id);
        $position->positionName = $request->positionName;
        $position->save();
        return response()->json(['message'=>'Position updated','data'=>$position],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePosition($id)
    {
        return Position::destroy($id);
    }
}
