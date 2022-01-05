<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alumni;
use App\Models\WorkExperience;
use App\Models\AlumniSkill;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function getUsers(){

        return User::with('alumni')->latest()->get();
        
    }

    public function getUser(Request $request, $id){
        $user = User::with('alumni')->findOrFail($id);
        $workExperience = WorkExperience::join('companies', 'companies.id', '=', 'work_experiences.company_id')
        ->join('positions', 'positions.id', '=', 'work_experiences.position_id')
        ->join('alumnis', 'alumnis.id', '=', 'work_experiences.alumni_id')
        ->where([['work_experiences.alumni_id','=',$user->alumni->id]])
        ->orderBy('work_experiences.id','DESC')
        ->get(['work_experiences.id','work_experiences.alumni_id','positionName','companyName','companies.id as company_id','phone','email','domain','address','logo','start_year','end_year']);
        
        $skills = AlumniSkill::join('alumnis', 'alumnis.id', '=', 'alumni_skills.alumni_id')
        ->join('skills', 'skills.id', '=', 'alumni_skills.skill_id')
        ->where([['alumni_skills.alumni_id','=',$user->alumni->id]])
        ->orderBy('alumni_skills.id','DESC')
        ->get(['skills.*', 'alumni_skills.id']);

        return response()->json(['user'=>$user, 'workExperience'=> $workExperience, 'skills'=> $skills]);
    }

    public function createUser(Request $request)
    {
        $users = $request->input();
        foreach($users as $data){
            // dd($data);
            // $data->validate([
            // "first_name"=>"nullable",
            // "last_name"=>"nullable",
            // "password"=>"nullable",
            // 'email' => 'required|email|unique:users,email',
            // 'role' => "required"
            // ]);
            //move image to storage
            
    
            if ($data['role'] === 'alumni'){
                $user = new User();
                $user->email = $data['email'];
                $user->role = $data['role'];
                $user->save();

                $alumni = new Alumni();
                $alumni->status = $data['status'];
                $alumni->user_id = $user->id;
                $alumni->profile = 'default_profile.png';
                $alumni->save();
            }else{
                $user = new User();
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->role = $data['role'];
                $user->save();
            }
            // $token = $user->createToken("mytoken")->plainTextToken;
            $token = $user->createToken('token-'.$request->role)->plainTextToken;   

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
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('token-'.$user->role)->plainTextToken;
        return response()->json(["message"=>"Post Updated","user"=>$user,"token"=>$token],201);
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
