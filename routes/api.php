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

// 必要なユーザー情報などを一括取得（ログイン時）
Route::post('/user/login', [UserController::class, 'action_index_post'])->middleware('line.auth');

// ユーザー情報の更新
Route::put('/user', [UserController::class, 'action_index_put']);

// お気に入りに追加する
Route::post('/favorite', [FavoriteController::class, 'action_index_post']);

// お気に入りから外す（DBレコードは消さない）
Route::delete('/favorite', [FavoriteController::class, 'action_index_delete']);

// 質問の投稿
Route::post('/question', [QuestionController::class, 'action_index_post']);

// 質問の削除
Route::delete('/question', [QuestionController::class, 'action_index_delete']);

// 新規レポートの取得（タイムラインの更新）
Route::get('/report', [ReportController::class, 'action_index_get']);

// レポートの投稿
Route::post('/report', [ReportController::class, 'action_index_post'])->middleware('line.auth');

// レポートの削除
Route::delete('/report', [ReportController::class, 'action_index_delete']);

// テスト（デバック用）
Route::get('/test', [TestController::class, 'action_index']);
