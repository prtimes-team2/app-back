<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use App\Models\Report;
use App\Models\Tag;
use App\Models\Coinlog;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // ログイン時の情報を全て返す（/user/login [POST]）
    public function action_index_post(Request $request){
        try{
            $line_id = $request->user_id;
            $DisplayName = $request->DisplayName;
            $ProfileImageUrl = $request->ProfileImageUrl;
            $user = User::where('line_id', $line_id)->first();
            if ($user) {
                $user_id = $user->id;

                // 地元の最新レポートを最大20件を取得
                $getReports = Report::with(['users', 'imageurls', 'tags'])
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();
                //dd($getReports);
                foreach ($getReports as $report) {
                    //dd($report->users);
                    $newReport = [
                        'id' => $report->id,
                        'title' => $report->title,
                        'content' => $report->content,
                        'address' => $report->address,
                        'lat' => $report->lat,
                        'lng' => $report->lng,
                        'created_at' => $report->created_at,
                        'updated_at' => $report->updated_at,
                        'imageUrls' => $report->imageurls->pluck('ImageUrl')->toArray(),
                        'tags' => $report->tags->pluck('name'),
                        'author' => $report->users->DisplayName,// ImageUrlとは違ってpluck()なしで指定できた
                        'user_id' => $report->users->line_id,// authorのline_id
                    ];
                    $newReports[] = $newReport;
                }
                // コインログを取得
                $getCoinlogs = Coinlog::orderBy('created_at', 'desc')
                    ->where('user_id', $user_id)
                    ->get();
                foreach ($getCoinlogs as $coinlog) {
                    $newCoinlog = [
                        'id' => $coinlog->id,
                        'user_id' => $coinlog->user_id,
                        'amount' => $coinlog->amount,
                        'created_at' => $coinlog->created_at,
                        'updated_at' => $coinlog->updated_at,
                    ];
                    $newCoinlogs[] = $newCoinlog;
                }
                // favorite済みののレポートを取得
                $getFavoriteReports = Favorite::with(['reports', 'reports.users', 'reports.imageurls', 'reports.tags'])
                    ->orderBy('created_at', 'desc')
                    ->where('user_id', $user_id)
                    ->where('isFavorite', 1)
                    ->get();
                //dd($getFavorites);
                foreach ($getFavoriteReports as $favorite_report) {
                    $newFavoriteReport = [
                        'id' => $favorite_report->reports->id,
                        'title' => $favorite_report->reports->title,
                        'content' => $favorite_report->reports->content,
                        'address' => $favorite_report->reports->address,
                        'lat' => $favorite_report->reports->lat,
                        'lng' => $favorite_report->reports->lng,
                        'created_at' => $favorite_report->reports->created_at,
                        'updated_at' => $favorite_report->reports->updated_at,
                        'imageUrls' => $favorite_report->imageurls ? $favorite_report->imageurls->pluck('ImageUrl')->toArray() : [],
                        'tags' => $favorite_report->tags ? $favorite_report->tags->pluck('name') : [],
                        'author' => $favorite_report->users->DisplayName,
                        'user_id' => $favorite_report->users->line_id, //authorのline_id
                    ];
                    $newFavoriteReports[] = $newFavoriteReport;
                }
                // 自分が書いたレポートを取得
                $getMyReports = Report::with(['users', 'imageurls', 'tags'])
                    ->orderBy('created_at', 'desc')
                    ->where('user_id', $user_id)
                    ->get();
                foreach ($getMyReports as $myreport) {
                    $newMyReport = [
                        'id' => $myreport->id,
                        'title' => $myreport->title,
                        'content' => $myreport->content,
                        'address' => $myreport->address,
                        'lat' => $myreport->lat,
                        'lng' => $myreport->lng,
                        'created_at' => $myreport->created_at,
                        'updated_at' => $myreport->updated_at,
                        'imageUrls' => $myreport->imageurls->pluck('ImageUrl')->toArray(),
                        'tags' => $myreport->tags->pluck('name'),
                        'author' => $myreport->users->DisplayName,
                        'user_id' => $myreport->users->line_id,
                    ];
                    $newMyReports[] = $newMyReport;
                }
                    $res = [
                        'User' => [
                            'id' => $user->id,
                            'line_id' => $user->line_id,
                            'DisplayName' => $user->DisplayName,
                            'ProfileImageUrl' => $user->ProfileImageUrl,
                            'prefecture' => $user->prefecture,
                            'city' => $user->city,
                            'birth' => $user->birth,
                            'gender' => $user->gender,
                            'created_at' => $user->created_at,
                            'updated_at' => $user->updated_at,
                            'deleted_at' => $user->deleted_at,
                        ],
                        'Reports' => $newReports ?? json_decode('[]'),
                        'Coinlogs' => $newCoinlogs ?? json_decode('[]'),
                        'FavoriteReports' => $newFavoriteReports ?? json_decode('[]'),
                        'MyReports' => $newMyReports ?? json_decode('[]'),
                    ]; 
            } else {
                $user = new User();
                $user->line_id = $line_id;
                $user->DisplayName = $DisplayName;
                $user->ProfileImageUrl = $ProfileImageUrl;
                $user->save();
                $res = ['message' => 'Successfully Create User Information.'];
            }
            return response()->json($res, 200);
        } 
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
    
    // ユーザー情報のアップデート（/user [PUT]）
    public function action_index_put(Request $request){
        try{
            $user_id = $request->user_id;
            // ?? nullは$request->input('hogehoge')が存在しなかった場合nullを代入する
            // queryパラメータはinput()でも取得できる
            $DisplayName = $request->input('DisplayName') ?? null;
            $ProfileImageUrl = $request->input('ProfileImageUrl') ?? null;
            $prefecture = $request->input('prefecture') ?? null;
            $city = $request->input('city') ?? null;
            $birth = $request->input('birth') ?? null;
            $gender = $request->input('gender') ?? null;
            $user = User::where('line_id', $user_id)->first();
            if ($user) {
                if (!is_null($DisplayName)) {$user->DisplayName = $DisplayName;}
                if (!is_null($ProfileImageUrl)) {$user->ProfileImageUrl = $ProfileImageUrl;}
                if (!is_null($prefecture)) {$user->prefecture = $prefecture;}
                if (!is_null($city)) {$user->city = $city;}
                if (!is_null($birth)) {$user->birth = $birth;}
                if (!is_null($gender)) {$user->gender = $gender;}
                $user->save();
            } else {
                // $user_idに一致するレコードが存在しない場合のエラーハンドリング
                $res = ['message' => 'Could Not Find User.'];
                return response()->json($res, 200);
            }
            $res = ['message' => 'Successfully Update User Information.'];
            return response()->json($res, 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
