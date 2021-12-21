<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alumni;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function getUsers(){
        return User::latest()->get();
    }

    public function getUser(Request $request, $id){
        return User::findOrFail($id);
    }

    public function createUser(Request $request)
    {
        $request->validate([
        "first_name"=>"nullable",
        "last_name"=>"nullable",
        "password"=>"nullable",
        'email' => 'required|email|unique:users,email',
        'role' => "required"
        ]);
        //move image to storage
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        if ($request->role === 'alumni'){
            $alumni = new Alumni();
            $alumni->phone_number = $request->phone_number;
            $alumni->gender = $request->gender;
            $alumni->batch = $request->batch;
            $alumni->major = $request->major;
            $alumni->user_id = $user->id;
            $alumni->profile = 'default_profile.jpg';
            $alumni->save();
        }
        return response()->json(["message"=>"User Created", 'data'=>$user],200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->save();

        if ($request->role === 'alumni'){
            $alumni = Alumni::findorfail($request->alumni_id);
            $alumni->phone_number = $request->phone_number;
            $alumni->gender = $request->gender;

            $alumni->save();
        }
        return response()->json(["message"=>"Post Updated","user"=>$user],201);
    }

    public function deleteUser($id)
    {
        $isDelete = User::destroy($id);
        if($isDelete){
            return response()->json(["message"=>"deleted"],201);
        }
        return response()->json(["message"=>"deleted_error"],404);
    }
    public function signIn(Request $request){
        $user = User::where("email",$request->email)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
            return response()->json(["message"=>"Username or Password Invalid"],401);
        }
        return response()->json([
            "user"=>$user,
        ]);
    }
}
