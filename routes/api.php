<?php

use App\Http\Controllers\Api\RegisterationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 Route::post('/register',[RegisterationController::class,'Register']);
 Route::post('/login',[RegisterationController::class,'Login']);
 Route::post('/logout',[RegisterationController::class,'Logout'])->middleware('auth:sanctum');

 Route::get('/courses', [CourseController::class, 'index']);
 Route::post('/courses', [CourseController::class, 'store']);
 Route::get('/courses/{id}', [CourseController::class, 'show']);
 Route::put('/courses/{id}', [CourseController::class, 'update']); 
 Route::delete('/courses/{id}', [CourseController::class, 'destroy']);