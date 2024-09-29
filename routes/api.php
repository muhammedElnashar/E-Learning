<?php

use App\Http\Controllers\Api\RegisterationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 Route::post('/register',[RegisterationController::class,'Register']);
 Route::post('/login',[RegisterationController::class,'Login']);

Route::apiResource('tests', Api\TestController::class);
Route::apiResource('questions', Api\QuestionController::class);
Route::apiResource('answers', Api\AnswerController::class);
Route::apiResource('user-answers', Api\UserAnswerController::class);
Route::apiResource('scores', Api\ScoreController::class);
