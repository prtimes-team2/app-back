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
            $user_id = $user->id;
            
            // 地元の最新レポートを最大20件を取得
            $getReports = Report::orderBy('created_at', 'desc')
                ->limit(20)
                ->get();
            foreach ($getReports as $report) {
                $report_id = $report->id;
                $author_id = $report->user_id;
                $author_line_id = User::where('id', $author_id)->first()->line_id;

                // usersテーブルからレコードを取得
                $authors = DB::table('users')
                    ->where('id', $author_id)
                    ->pluck('DisplayName');
            
                // imageurlsテーブルからレコードを取得
                $imageUrls = DB::table('imageurls')
                    ->where('report_id', $report_id)
                    ->pluck('imageUrl')
                    ->toArray();
            
                // report_tag中間テーブルからレコードを取得
                $tags = DB::table('report_tag')
                    ->join('tags', 'report_tag.tag_id', '=', 'tags.id')
                    ->where('report_tag.report_id', $report_id)
                    ->pluck('tags.name')
                    ->toArray();
            
                $newReport = [
                    'id' => $report->id,
                    'title' => $report->title,
                    'content' => $report->content,
                    'address' => $report->address,
                    'lat' => $report->lat,
                    'lng' => $report->lng,
                    'created_at' => $report->created_at,
                    'updated_at' => $report->updated_at,
                    'imageUrls' => $imageUrls,
                    'tags' => $tags,
                    'author' => $authors,
                    'user_id' => $author_line_id,// authorのline_id
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
            //$favorite_reportIds =  $reports->pluck('user_id');
            // favorite中のレポートを取得
            $getFavorites = Favorite::orderBy('created_at', 'desc')
                ->where('isFavorite', 1)
                ->get();
            // dd($getFavorites);
            foreach ($getFavorites as $favorite) {
                $favorite_report_id = $favorite->report_id;
                $favorite_report = Report::orderBy('created_at', 'desc')
                ->where('id', $favorite_report_id)
                ->get();
                //dd($favorite_report->first()->user_id);
                
                $favorite_author_id = $favorite_report->first()->user_id;
                $favorite_author_line_id = User::where('id', $favorite_author_id)->first()->line_id;
                
                // usersテーブルからレコードを取得
                $favorite_authors = DB::table('users')
                    ->where('id', $favorite_author_id)
                    ->pluck('DisplayName');
            
                // imageurlsテーブルからレコードを取得
                $favorite_imageUrls = DB::table('imageurls')
                    ->where('report_id', $favorite_report_id)
                    ->pluck('imageUrl')
                    ->toArray();
            
                // report_tag中間テーブルからレコードを取得
                $favorite_tags = DB::table('report_tag')
                    ->join('tags', 'report_tag.tag_id', '=', 'tags.id')
                    ->where('report_tag.report_id', $favorite_report_id)//->get();
                    ->pluck('tags.name')
                    ->toArray();
            
                $newFavoriteReport = [
                    'id' => $favorite_report->first()->id,
                    'title' => $favorite_report->first()->title,
                    'content' => $favorite_report->first()->content,
                    'address' => $favorite_report->first()->address,
                    'lat' => $favorite_report->first()->lat,
                    'lng' => $favorite_report->first()->lng,
                    'created_at' => $favorite_report->first()->created_at,
                    'updated_at' => $favorite_report->first()->updated_at,
                    'imageUrls' => $favorite_imageUrls,
                    'tags' => $favorite_tags,
                    'author' => $favorite_authors,
                    'user_id' => $favorite_author_line_id,
                ];
        
                $newFavoriteReports[] = $newFavoriteReport;
            }
            // 自分が書いたレポートを取得
            $getMyReports = Report::orderBy('created_at', 'desc')
                ->where('user_id', $user_id)
                ->get();
            foreach ($getMyReports as $myreport) {
                $myreport_id = $myreport->id;

                // usersテーブルからレコードを取得
                $authors = DB::table('users')
                    ->where('id', $user_id)
                    ->pluck('DisplayName');
            
                // imageurlsテーブルからレコードを取得
                $imageUrls = DB::table('imageurls')
                    ->where('report_id', $myreport_id)
                    ->pluck('imageUrl')
                    ->toArray();
            
                // report_tag中間テーブルからレコードを取得
                $tags = DB::table('report_tag')
                    ->join('tags', 'report_tag.tag_id', '=', 'tags.id')
                    ->where('report_tag.report_id', $myreport_id)//->get();
                    ->pluck('tags.name')
                    ->toArray();
            
                $newMyReport = [
                    'id' => $myreport->id,
                    'title' => $myreport->title,
                    'content' => $myreport->content,
                    'address' => $myreport->address,
                    'lat' => $myreport->lat,
                    'lng' => $myreport->lng,
                    'created_at' => $myreport->created_at,
                    'updated_at' => $myreport->updated_at,
                    'imageUrls' => $imageUrls,
                    'tags' => $tags,
                    'author' => $authors,
                    'user_id' => $line_id,
                ];
        
                $newMyReports[] = $newMyReport;
            }
            if ($user) {
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
                $user->line_id = $user_id;
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