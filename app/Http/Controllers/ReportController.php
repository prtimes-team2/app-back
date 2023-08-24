<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * 新規レポートの取得（タイムラインの更新）
     * 更新ボタンを押した際に、新規のレポートを取得して返す
     * /report [GET]
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function action_index_post(Request $request){
        try{
            // リクエストからuser_idを取得
            $line_id = $request->user_id;

            // データベースに登録
            $report = new Report();
            $report->user_id = DB::table('users')->where('line_id', $line_id)->value('id');
            $report->title = $request->title;
            $report->content = $request->content;
            $report->address = $request->address;
            $report->lat = $request->lat;
            $report->lng = $request->lng;
            $report->save();

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
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function action_index_delete(Request $request){
        try{
            // リクエストからreportIdを取得
            $report_id = $request->query('reportId');

            // データベースから削除
            $report = Report::find($report_id);
            if ($report) {
                $report->delete();
            } 
            else {
                // $report_idに一致するレコードが存在しない場合のエラーハンドリング
                $res = ['message' => 'Could Not Find Report.'];
                return response()->json($res, 400);
            }

            return response()->json(['message' => 'Successfully Deleted The Report.'], 200);
        } 
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
