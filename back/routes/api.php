<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AlumniPositionController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AlumniSkillController;


// USER SIGN, SIGN UP, SIGN OUT
Route::post('signin',[UserController::class, "signIn"]);
Route::get('users',[UserController::class,'getUsers']);
Route::get('alumnis',[AlumniController::class,'getAllAlumni']);
Route::put('users/{user_id}',[UserController::class,'updateUser']);
Route::put('alumnis/{alumni_id}',[AlumniController::class,'updateAlumni']);


// Route::get('alumnis/{alumni_id}',[AlumniController::class,'getOneAlumni']);
// Route::get('users/{user_id}',[UserController::class,'getUser']);



Route::group(['middleware' => 'auth:sanctum'], function () {

    // Route::get('users',[UserController::class,'getUsers']);
    Route::post('signout',[UserController::class, "signOut"]);
    Route::get('users/{user_id}',[UserController::class,'getUser']);
    Route::post('users',[UserController::class,'createUser']);
    // Route::put('users/{user_id}',[UserController::class,'updateUser']);
    Route::delete('users/{user_id}',[UserController::class,'deleteUser']);

    // Route::get('alumnis',[AlumniController::class,'getAllAlumni']);
    Route::post('alumnis',[AlumniController::class,'createAlumni']);
    Route::get('alumnis/{alumni_id}',[AlumniController::class,'getOneAlumni']);
    // Route::put('alumnis/{alumni_id}',[AlumniController::class,'updateAlumni']);
    Route::put('alumnisProfile/{alumni_id}',[AlumniController::class,'updateAlumniPrifile']);
    Route::delete('alumnis/{alumni_id}',[AlumniController::class,'deleteAlumni']);
    // Route::get('/alumnis/search/{name}', [AlumniController::class, 'searchCategory']);

    Route::get('companies',[CompanyController::class,'getAllCompany']);
    Route::post('companies',[CompanyController::class,'createCompany']);
    Route::get('companies/{company_id}',[CompanyController::class,'getOneCompany']);
    Route::put('companies/{company_id}',[CompanyController::class,'updateCompany']);
    Route::delete('companies/{company_id}',[CompanyController::class,'deleteCompany']);

    Route::get('positions',[PositionController::class,'getAllPosition']);
    Route::post('positions',[PositionController::class,'createPosition']);
    Route::get('positions/{position_id}',[PositionController::class,'getOnePosition']);
    Route::put('positions/{position_id}',[PositionController::class,'updatePosition']);
    Route::delete('positions/{position_id}',[PositionController::class,'deletePosition']);

    Route::get('work_experiences',[WorkExperienceController::class,'getAllWorkExperience']);
    Route::get('work_experiences/{id}',[WorkExperienceController::class,'getOneWorkExperience']);
    Route::post('work_experiences',[WorkExperienceController::class,'createWorkExperience']);
    Route::put('work_experiences/{id}',[WorkExperienceController::class,'updateWorkExperience']);
    Route::delete('work_experiences/{id}',[WorkExperienceController::class,'deleteWorkExperience']);

    Route::get('skills',[SkillController::class,'getAllSkill']);
    Route::post('skills',[SkillController::class,'createSkill']);
    Route::get('skills/{skill_id}',[SkillController::class,'getOneSkill']);
    Route::put('skills/{skill_id}',[SkillController::class,'updateSkill']);
    Route::delete('skills/{skill_id}',[SkillController::class,'deleteSkill']);

    Route::post('send-mails',[UserController::class,'sendEmail']);

    Route::delete('alumniSkill/{id}',[AlumniSkillController::class,'deleteAlumniSkill']);
    Route::get('alumniSkill/{id}',[AlumniSkillController::class,'show']);
});
