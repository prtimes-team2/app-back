<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestController;

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
// ログイン時の情報を全て返す
Route::post('/user/login', [UserController::class, 'action_index_post'])->middleware('line.auth');

// ユーザー情報のアップデート
Route::put('/user', [UserController::class, 'action_index_put']);

Route::post('/favorite', [FavoriteController::class, 'action_index_post']);
Route::delete('/favorite', [FavoriteController::class, 'action_index_delete']);
Route::post('/question', [QuestionController::class, 'action_index_post']);
Route::delete('/question', [QuestionController::class, 'action_index_delete']);
Route::get('/report', [ReportController::class, 'action_index_get']);
Route::post('/report', [ReportController::class, 'action_index_post']);
Route::delete('/report', [ReportController::class, 'action_index_delete']);

Route::get('/test', [TestController::class, 'action_index']);
