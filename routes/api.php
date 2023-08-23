<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineLoginController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/line', [LineLoginController::class, 'action_index']);
Route::post('/favorite', [FavoriteController::class, 'action_index']);
Route::delete('/favorite', [FavoriteController::class, 'action_index']);
Route::post('/question', [QuestionController::class, 'action_index']);
Route::delete('/question', [QuestionController::class, 'action_index']);
