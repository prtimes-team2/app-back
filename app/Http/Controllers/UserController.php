<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class UserController extends Controller
{
    // ログイン時の情報を全て返す（/user/login [POST]）
    public function action_index_post(Request $request){
        try{
            $user_id = $request->user_id;
            $DisplayName = $request->DisplayName;
            $ProfileImageUrl = $request->ProfileImageUrl;
            $user = User::where('line_id', $user_id)->first();
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
                    ]
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
            $DisplayName = $request->input('DisplayName') ?? null;
            $ProfileImageUrl = $request->input('ProfileImageUrl') ?? null;
            $prefecture = $request->input('prefecture') ?? null;
            $city = $request->input('city') ?? null;
            $birth = $request->input('birth') ?? null;
            $gender = $request->input('gender') ?? null;
            $user = User::where('line_id', $user_id)->first();
            if ($user) {
                $user->DisplayName = $DisplayName;
                $user->save();
            } else {
                // $user_idに一致するレコードが存在しない場合のエラーハンドリング
                $res = ['message' => 'Could Not Find User.'];
                return response()->json($res, 200);
            }
            if (!is_null($DisplayName)) {$user->DisplayName = $DisplayName;}
            if (!is_null($ProfileImageUrl)) {$user->ProfileImageUrl = $ProfileImageUrl;}
            if (!is_null($prefecture)) {$user->prefecture = $prefecture;}
            if (!is_null($city)) {$user->city = $city;}
            if (!is_null($birth)) {$user->birth = $birth;}
            if (!is_null($gender)) {$user->gender = $gender;}
            $user->save();
            $res = ['message' => 'Successfully Update User Information.'];
            return response()->json($res, 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}