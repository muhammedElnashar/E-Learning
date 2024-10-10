<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\RegisterationController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\organizarController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\UserAnswerController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\EnrollmentController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::post('/register', [RegisterationController::class,'Register']);
Route::post('/login', [RegisterationController::class,'Login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/students', RegisterationController::class);
    Route::post('/student/{id}/restore', [RegisterationController::class, 'restore']);
    Route::get('/students-trashed', [RegisterationController::class, 'trashed']);
    Route::post('/logout', [RegisterationController::class,'Logout']);
    //organizer and teacher
    Route::get('/teacher', [organizarController::class, 'getAllTeachers']);
    Route::get('/teacher/{id}', [organizarController::class, 'getTeacher']);
    Route::apiResource('/organizar', organizarController::class);
    Route::post('/organizar/{id}/restore', [organizarController::class, 'restore']);
    Route::get('/organizartrashed', [organizarController::class, 'trashed']);
    //test
    Route::post("/upload-exam", [TestController::class,'storeExamFile']);
    Route::apiResource('tests', TestController::class);
    Route::get('tests-answer/{id}', [TestController::class,'ShowCorrectTestAnswer']);
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('answers', AnswerController::class);
    Route::apiResource('user-answers', UserAnswerController::class);
    Route::apiResource('scores', ScoreController::class);
    //Course
    Route::apiResource('/courses', CourseController::class);
    Route::apiResource('playlists', PlaylistController::class);
    Route::apiResource('videos', VideoController::class);

//payment
    Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
    Route::post('/store-payment', [PaymentController::class, 'storePayment']);
    Route::get('/user-payments', [PaymentController::class, 'getPayments']);
    Route::get('/payments', [PaymentController::class, 'getAllPayments']);
    //enrollment
    Route::get('enrollments', [EnrollmentController::class, 'index']);
    Route::get('enrollments', [EnrollmentController::class, 'show']);


//comment
Route::post('course/{course}', [CommentController::class, 'store']);
Route::get('course/{course}/comments', [CommentController::class, 'index']);
Route::delete('comment/{id}', [CommentController::class, 'destroy']);
Route::get('user-score/{id}',[RegisterationController::class, 'getScore']);
});





