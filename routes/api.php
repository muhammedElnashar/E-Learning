<?php

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\RegisterationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 Route::post('/register',[RegisterationController::class,'Register']);
 Route::post('/login',[RegisterationController::class,'Login']);
 Route::post('/logout',[RegisterationController::class,'Logout'])->middleware('auth:sanctum');
Route::post("/exam-store", [QuestionController::class,'store']);
