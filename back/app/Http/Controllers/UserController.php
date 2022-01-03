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

        return User::with('alumni')->latest()->get();
        
    }

    public function getUser(Request $request, $id){
        return User::with('alumni')->findOrFail($id);
        
    }

    public function createUser(Request $request)
    {
        // $request = $request->toArray();
        // foreach($request as $data){
            // dd($data);
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
                $alumni->status = $request->status;
                $alumni->user_id = $user->id;
                $alumni->profile = 'default_profile.png';
                $alumni->save();
            }
            // $token = $user->createToken("mytoken")->plainTextToken;
            $token = $user->createToken('token-'.$request->role)->plainTextToken;   

        // }
        return response()->json(["message"=>"User Created", 'data'=>$user],200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
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
        $token = $user->createToken('token-'.$user->role)->plainTextToken;
        return response()->json([
            "user"=>$user,
            "token"=>$token,
        ],201);
    }
    public function signOut(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Sign out',
            'status_code' => 200
        ], 200);
    }
}
