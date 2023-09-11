<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Models\Coinlog;
use App\Models\Imageurl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function action_index_get(Request $request){
        try{
            // クエリパラメータからaddressを取得
            $address = $request->query('address');

            // 地元の最新レポートを最大1000件を取得
            $getReports = Report::getLatest($address);

            return response()->json($getReports->toArray());
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }

    /**
     * @param CreateReportRequest $request
     * @return JsonResponse
     */
    public function action_index_post(CreateReportRequest $request){
        DB::beginTransaction();

        try{
            // リクエストからuser_id（line_id）を取得
            $line_id = $request->user_id;

            // 取得したline_idをもとにusersテーブルから対象ユーザーのidを取得
            $user_id = DB::table('users')->where('line_id', $line_id)->value('id');

            // reportsテーブル
            $report = $request->toReport();
            $report->save();

            // report_tagテーブル
            foreach ($request->tags as $tag) {
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

            // coinlogsテーブル
            $coinlog = new Coinlog();
            $coinlog->user_id = $user_id;
            $coinlog->amount = 5;
            $coinlog->save();

            DB::commit();

            return response()->json(['amount' => 5], 200);
        }
        catch (\Throwable $e) {
            DB::rollBack();

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
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }
}
