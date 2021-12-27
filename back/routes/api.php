<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AlumniPositionController;
use App\Http\Controllers\WorkExperienceController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('signin',[UserController::class, "signIn"]);
Route::post('signout',[UserController::class, "signOut"]);

Route::get('users',[UserController::class,'getUsers']);
Route::get('users/{user_id}',[UserController::class,'getUser']);
Route::post('users',[UserController::class,'createUser']);
Route::put('users/{user_id}',[UserController::class,'updateUser']);
Route::delete('users/{user_id}',[UserController::class,'deleteUser']);

Route::get('alumnis',[AlumniController::class,'getAllAlumni']);
Route::post('alumnis',[AlumniController::class,'createAlumni']);
Route::get('alumnis/{alumni_id}',[AlumniController::class,'getOneAlumni']);
Route::put('alumnis/{alumni_id}',[AlumniController::class,'updateAlumni']);
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
