<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('signin',[UserController::class, "signIn"]);
Route::post('signout',[UserController::class, "signOut"]);

Route::get('users',[UserController::class,'getUsers']);
Route::post('users',[UserController::class,'createUser']);
Route::put('users/{user_id}',[UserController::class,'updateUser']);
Route::delete('users/{user_id}',[UserController::class,'deleteUser']);

Route::get('alumnis',[AlumniController::class,'getAllAlumni']);
Route::post('alumnis',[AlumniController::class,'createAlumni']);
Route::get('alumnis/{alumni_id}',[AlumniController::class,'getOneAlumni']);
Route::put('alumnis/{alumni_id}',[AlumniController::class,'updateAlumni']);
Route::delete('alumnis/{alumni_id}',[AlumniController::class,'deleteAlumni']);
// Route::get('/alumnis/search/{name}', [AlumniController::class, 'searchCategory']);
