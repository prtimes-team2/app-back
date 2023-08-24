<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;

class FavoriteController extends Controller
{
    public function action_index_post(Request $request){
        try{
            $line_id = $request->user_id;
            $user = User::where('line_id', $line_id)->first();
            $user_id = $user->id;
            $report_id = $request->input('reportId');
            $favorite = Favorite::where('user_id', $user_id)->where('report_id', $report_id)->first();
            if ($favorite) {
                $favorite->isFavorite = true;
                $favorite->save();
                $res = ['message' => 'Successfully Update Favorite Information.'];
            } else {
                $favorite = new Favorite();
                $favorite->user_id = $user_id;
                $favorite->report_id = $report_id;
                $favorite->isFavorite = true;
                $favorite->save();
                $res = ['message' => 'Successfully Create Favorite Information.'];
            }
            return response()->json($res, 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
    public function action_index_delete(Request $request){
        try{
            $line_id = $request->user_id;
            $user = User::where('line_id', $line_id)->first();
            $user_id = $user->id;
            $report_id = $request->input('reportId');
            $favorite = Favorite::where('user_id', $user_id)->where('report_id', $report_id)->first();
            if ($favorite) {
                $favorite->isFavorite = false;
                $favorite->save();
            } else {
                // $user_id, $report_idに一致するレコードが存在しない場合のエラーハンドリング
                $res = ['message' => 'Could Not Find The Record.'];
                return response()->json($res, 200);
            }
            $res = ['message' => 'Successfully Delete Favorite Information.'];
            return response()->json($res, 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
