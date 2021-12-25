<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    public function getUsers(){

        return User::with('alumni')->get();
        // ->where([['event__joins.event_id','=',$eventId],['event__joins.role','=','member']])
        // ->get(['users.*','alumnis.*']);
        // return $event_join_members;
        // return UserResource::collection(User::get());
    }

    public function getUser(Request $request, $id){
        return User::findOrFail($id);
    }

    public function createUser(Request $request)
    {
        $request->validate([
        "first_name"=>"required|min:2|max:30",
        "last_name"=>"required|min:2|max:30",
        "password"=>"required|confirmed|min:8|max:16",
        'email' => 'required|email|unique:users,email',
        ]);
        //move image to storage
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        return response()->json(["message"=>"User Created", 'data'=>$user],200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();
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
