<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * 新規レポートの取得（タイムラインの更新）
     * 更新ボタンを押した際に、新規のレポートを取得して返す
     * /report [GET]
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse JSON形式の新規レポート情報
     */
    public function action_index_get(Request $request){
        try{
            return response()->json([], 200);
        } 
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }

    /**
     * レポートの投稿
     * POSTで渡されたレポート情報をreportsテーブルに登録
     * /report [POST]
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse JSON形式のHTTPステータスコード
     */
    public function action_index_post(Request $request){
        try{


            return response()->json(['message' => 'Successfully Submitted The Report.'], 200);
        }
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }

    /**
     * レポートの削除
     * POSTで渡されたレポート情報をreportsテーブルから削除
     * /report [DELETE]
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse JSON形式のHTTPステータスコード
     */
    public function action_index_delete(Request $request){
        try{

            return response()->json(['message' => 'Successfully Deleted The Report.'], 200);
        } 
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
