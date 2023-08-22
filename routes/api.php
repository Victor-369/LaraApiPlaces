<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceApiController;
use App\Http\Controllers\CommentApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Places
Route::get('/places', [PlaceApiController::class, 'index']);
Route::get('/place/{place}', [PlaceApiController::class, 'show'])->where('place', '^\d+$'); // Only numbers
Route::get('/places/{field}/{value}', [PlaceApiController::class, 'search'])->where('field', '^place|description$');
Route::post('/place', [PlaceApiController::class, 'store']);
Route::put('/place/{place}', [PlaceApiController::class, 'update']);
Route::delete('/place/{place}', [PlaceApiController::class, 'delete']);

// Comments
Route::get('/comments', [CommentApiController::class, 'index']);
Route::get('/comment/{comment}', [CommentApiController::class, 'show'])->where('comment', '^\d+$'); // Only numbers
Route::get('/comments/{field}/{value}', [CommentApiController::class, 'search'])->where('field', '^comment|place_id$');
Route::post('/comment', [CommentApiController::class, 'store']);
Route::put('/comment/{place}', [CommentApiController::class, 'update']);
Route::delete('/comment/{place}', [CommentApiController::class, 'delete']);

// Wrong request
Route::fallback(function() {
    return response(['status' => 'BAD REQUEST'], 400);
});