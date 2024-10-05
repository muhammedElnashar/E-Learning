<?php

use App\Http\Controllers\Api\RegisterationController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\organizarController;
use App\Models\Playlist;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\UserAnswerController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\CourseController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::post('/register', [RegisterationController::class,'Register']);
Route::post('/login', [RegisterationController::class,'Login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [RegisterationController::class,'Logout']);
    //organizer and teacher
    Route::apiResource('/organizar', organizarController::class);
    Route::post('/organizar/{id}/restore', [organizarController::class, 'restore']);
    Route::get('/organizartrashed', [organizarController::class, 'trashed']);
    //test
    Route::post("/upload-exam", [TestController::class,'storeExamFile']);
    Route::apiResource('tests', TestController::class);
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('answers', AnswerController::class);
    Route::apiResource('user-answers', UserAnswerController::class);
    Route::apiResource('scores', ScoreController::class);
    //Course
    Route::apiResource('/courses', CourseController::class);
    Route::apiResource('playlists', PlaylistController::class);
    Route::apiResource('videos', VideoController::class);
});



