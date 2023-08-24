<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Coinlog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    /**
     * 回答の取得
     * 質問に紐づけられた回答を返す
     * /answer [GET]
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function action_index_get(Request $request){
        try{
            // クエリパラメータからquestionIdを取得
            $question_id = $request->query('questionId');

            // questionIdに関連するAnswerを取得
            $getAnswers = Answer::where('question_id', $question_id)->get();

            $answers = [];
            foreach ($getAnswers as $answer) {

                // userテーブルからDisplayNameを取得
                $displayName = User::find($answer->user_id)->DisplayName;

                // userテーブルからDisplayNameを取得
                $profileImageUrl = User::find($answer->user_id)->ProfileImageUrl;

                $newAnswer = [
                    'displayName' => $displayName,
                    'profileImageUrl' => $profileImageUrl,
                    'content' => $answer->content,
                    'created_at' => $answer->created_at,
                ];
            
                $answers[] = $newAnswer;
            }

            return response()->json($answers, 200);
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }
    /**
     * 回答の投稿
     * POSTで渡された回答情報をanswersテーブルに登録
     * /answer [POST]
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

            // answerテーブル
            $answer = new Answer();
            $answer->question_id = $request->question_id;
            $answer->user_id = $user_id;
            $answer->content = $request->content;
            $answer->save();

            // coinlogsテーブル
            $answer_ids = Answer::where('question_id', $request->question_id)->pluck('user_id');
            $reward = Question::find($request->question_id)->reward;
            $length = count($answer_ids);
            $coinlog = new Coinlog();
            if($length > 1){
                foreach ($answer_ids as $answer_id) {
                    if($user_id == $answer_id){
                        return response()->json(['amount' => 0], 200);
                    }
                }
                $reward =floor($reward / $length);
                if($reward >= 1){
                    $coinlog->user_id = $user_id;
                    $coinlog->amount = $reward;
                    $coinlog->save();
                }
                else{
                    $coinlog->user_id = $user_id;
                    $coinlog->amount = 1;
                    $coinlog->save();
                }
            }
            else{
                $coinlog->user_id = $user_id;
                $coinlog->amount = $reward;
                $coinlog->save();
            }
            return response()->json(['amount' => $reward], 200);

            
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }
}
