<?php

namespace App\Http\Controllers;

use App\Models\Imageurl;
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
            // クエリパラメータからaddressを取得
            $address = $request->query('address');

            // 地元の最新レポートを最大20件を取得
            $getReports = Report::where('address', $address)
                ->orderBy('created_at', 'desc')
                ->limit(20)
                ->get();

            $newReports = [];
            foreach ($getReports as $report) {
                $report_id = $report->id;
            
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
                ];
            
                $newReports[] = $newReport;
            }

            return response()->json($newReports, 200);
        } 
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
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
            // リクエストからuser_id（line_id）を取得
            $line_id = $request->user_id;

            // 取得したline_idをもとにusersテーブルから対象ユーザーのidを取得
            $user_id = DB::table('users')->where('line_id', $line_id)->value('id');

            // jsonデータ取得
            $jsonData = $request->json()->all();

            // ----------------------------------------------------
            // データベースに登録
            // ----------------------------------------------------

            // reportsテーブル
            $report = new Report();
            $report->user_id = $user_id;
            $report->title = $jsonData['title'];
            $report->content = $jsonData['content'];
            $report->address = $jsonData['address'];
            $report->lat = $jsonData['lat'];
            $report->lng = $jsonData['lng'];
            $report->save();

            // report_tagテーブル
            $tags = $jsonData['tags'];
            foreach ($tags as $tag) {
                DB::table('report_tag')->insert([
                    'tag_id' => $tag,
                    'report_id' => $report->id,
                    'isExist' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
            // imageurlsテーブル
            $urls = $jsonData['urls'];
            foreach ($urls as $url) {
                $imageUrl = new Imageurl();
                $imageUrl->report_id = $report->id;
                $imageUrl->ImageUrl = $url;
                $imageUrl->save();
            }
            // ----------------------------------------------------

            return response()->json(['message' => 'Successfully Submitted The Report.'], 200);
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
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
            // クエリパラメータからreportIdを取得
            $report_id = $request->query('reportId');

            // データベースから削除
            $report = Report::find((int)$report_id);
            $report->imageUrls()->delete();
            $report->tags()->detach();
            $report->delete();

            return response()->json(['message' => 'Successfully deleted the report.'], 200);
        } 
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.', '$report'=>$report_id], 500);
        }
    }
}
