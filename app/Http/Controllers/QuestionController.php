<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Coinlog;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * 質問の投稿
     * POSTで渡された質問情報をquestionsテーブルに登録
     * /question [POST]
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

            // questionテーブル
            $question = new Question();
            $question->user_id = $user_id;
            $question->prefecture = $request->prefecture;
            $question->city = $request->city;
            $question->reward = $request->reward;
            $question->content = $request->content;
            $question->save();

            // coinlogsテーブル
            $coinlog = new Coinlog();
            $coinlog->user_id = $user_id;
            $coinlog->amount = -$request->reward;
            $coinlog->save();

            return response()->json(['message' => 'Successfully submitted the question.'], 200);
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }

    /**
     * 質問の削除
     * POSTで渡された質問情報をquestionsテーブルから削除
     * /question [DELETE]
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function action_index_delete(Request $request){
        try{
            return response()->json([], 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
