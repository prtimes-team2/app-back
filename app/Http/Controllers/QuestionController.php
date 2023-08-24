<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Coinlog;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * 質問の取得（自分のもののみ）
     * 自分が投稿した質問の取得
     * /question/self [GET]
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function action_index_getSelf(Request $request){
        try{
            // リクエストからuser_id（line_id）を取得
            $line_id = $request->user_id;

            // 取得したline_idをもとにusersテーブルから対象ユーザーのidを取得
            $user_id = DB::table('users')->where('line_id', $line_id)->value('id');

            // 取得したprefectureとcityをもとにqustionsテーブルから対象レコードを取得
            $getQuestions = DB::table('questions')
                ->where('user_id', $user_id)
                ->get();

            $questions = [];
            foreach ($getQuestions as $question) {

                // userテーブルからDisplayNameを取得
                $displayName = User::find($question->user_id)->DisplayName;

                // userテーブルからDisplayNameを取得
                $profileImageUrl = User::find($question->user_id)->ProfileImageUrl;

                $newQuestion = [
                    'question_id' => $question->id,
                    'displayName' => $displayName,
                    'profileImageUrl' => $profileImageUrl,
                    'content' => $question->content,
                    'created_at' => $question->created_at,
                ];
            
                $questions[] = $newQuestion;
            }

            return response()->json($questions, 200);
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }

    /**
     * 質問の取得
     * POSTで渡された地元情報をもとにquestionsテーブルを検索して該当するレコードを返す
     * /question [GET]
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function action_index_get(Request $request){
        try{
            // リクエストからuser_id（line_id）を取得
            $line_id = $request->user_id;

            // 取得したline_idをもとにusersテーブルから対象ユーザーのidを取得
            $user_id = DB::table('users')->where('line_id', $line_id)->value('id');

            // クエリパラメータからprefectureを取得
            $prefecture = $request->query('prefecture');

            // クエリパラメータからcityを取得
            $city = $request->query('city');

            // 取得したprefectureとcityをもとにqustionsテーブルから対象レコードを取得
            $getQuestions = DB::table('questions')
                ->where('prefecture', $prefecture)
                ->where('city', $city)
                ->where('user_id', '!=', $user_id)
                ->get();

            $questions = [];
            foreach ($getQuestions as $question) {

                // userテーブルからDisplayNameを取得
                $displayName = User::find($question->user_id)->DisplayName;

                // userテーブルからDisplayNameを取得
                $profileImageUrl = User::find($question->user_id)->ProfileImageUrl;

                // rewardの取得
                $answer_ids = Answer::where('question_id', $question->id)->pluck('user_id');
                $reward = Question::find($question->id)->reward;
                $length = count($answer_ids);
                if($length > 0){
                    foreach ($answer_ids as $answer_id) {
                        if($user_id == $answer_id){
                            $reward = 0;
                        }
                    }
                    if($reward != 0){
                        $reward =floor($reward / $length+1);
                        if($reward < 1){
                            $reward = 1;
                        }
                    }
                }

                $newQuestion = [
                    'question_id' => $question->id,
                    'displayName' => $displayName,
                    'profileImageUrl' => $profileImageUrl,
                    'reward' => $reward,
                    'content' => $question->content,
                    'created_at' => $question->created_at,
                ];
            
                $questions[] = $newQuestion;
            }

            return response()->json($questions, 200);
        }
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }


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
            // クエリパラメータからquestionIdを取得
            $question_id = $request->query('questionId');

            // データベースから削除
            $question = Question::find((int)$question_id);
            $question->answers()->delete();
            $question->delete();

            return response()->json(['message' => 'Successfully deleted the question.'], 200);
        } 
        catch (\Throwable $e) {
            return response()->json(['error' => 'Could not process your request.'], 500);
        }
    }
}
