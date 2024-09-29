<?php

use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\RegisterationController;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 Route::post('/register',[RegisterationController::class,'Register']);
 Route::post('/login',[RegisterationController::class,'Login']);
 Route::post('/logout',[RegisterationController::class,'Logout'])->middleware('auth:sanctum');
 Route::get('playlists', [PlaylistController::class, 'index']);
 Route::get('playlists/{id}/videos', [PlaylistController::class, 'show']);
