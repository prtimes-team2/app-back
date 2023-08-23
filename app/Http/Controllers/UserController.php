<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class UserController extends Controller
{
    public function action_index_post(Request $request){
        try{
            // $user_idを取得
            $user_id = $request->user_id;

            // ダミーデータ
            $res = [
                'User' =>[
                    'id' => 1,
                    'line_id' => $user_id,
                    'DisplayName' => 'Brown',
                    'ProfileImageUrl' => 'brown.jpeg',
                    'prefecture' => '静岡県',
                    'city' => '富士市',
                    'birth' => '2002-08-23',
                    'gender' => 0,
                ],
                'Reports' =>[
                    'Report_1' =>[
                        'id' => 1,
                        'title' => 'aaaaa',
                        'tags' =>[
                            'tag_1' => 'food',
                            'tag_2' => 'shop',
                        ],
                        'content' => 'ご飯美味しいいいいいいいいい',
                        'address' => '静岡県富士市',
                        'lat' => 35.1613,
                        'lng' => 138.678216,
                        'imageUrls' =>[
                            'imageUrl_1' => 'aaa.jpeg',
                            'imageUrl_2' => 'bbb.jpeg',
                        ],
                        'author' => 'inoi1n3h8ruy0',
                    ],
                    'Report_2' => [
                        'id' => 2,
                        'title' => 'bbbb',
                        'tags' => [
                            'tag_1' => 'travel',
                        ],
                        'content' => '旅行楽しかった！',
                        'address' => '静岡県富士市',
                        'lat' => 35.1625,
                        'lng' => 138.675123,
                        'imageUrls' => [
                            'imageUrl_1' => 'ccc.jpeg',
                        ],
                        'author' => 'user123',
                    ],
                    'Report_3' => [
                        'id' => 3,
                        'title' => 'cccc',
                        'tags' => [
                            'tag_1' => 'nature',
                            'tag_2' => 'scenic',
                        ],
                        'content' => '自然の景色が素晴らしい',
                        'address' => '静岡県富士市',
                        'lat' => 35.1602,
                        'lng' => 138.680357,
                        'imageUrls' => [
                            'imageUrl_1' => 'eee.jpeg',
                            'imageUrl_2' => 'fff.jpeg',
                        ],
                        'author' => 'user456',
                    ],
                    'Report_4' => [
                        'id' => 4,
                        'title' => 'dddd',
                        'tags' => [
                            'tag_1' => 'culture',
                            'tag_2' => 'history',
                        ],
                        'content' => '歴史的な場所を訪れました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1638,
                        'lng' => 138.673789,
                        'imageUrls' => [
                            'imageUrl_1' => 'ggg.jpeg',
                            'imageUrl_2' => 'hhh.jpeg',
                        ],
                        'author' => 'user789',
                    ],
                    'Report_5' => [
                        'id' => 5,
                        'title' => 'eeee',
                        'tags' => [
                            'tag_1' => 'nature',
                            'tag_2' => 'photography',
                        ],
                        'content' => '美しい景色を写真に収めました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1597,
                        'lng' => 138.682479,
                        'imageUrls' => [
                            'imageUrl_1' => 'iii.jpeg',
                            'imageUrl_2' => 'jjj.jpeg',
                        ],
                        'author' => 'user1011',
                    ],
                    'Report_6' => [
                        'id' => 6,
                        'title' => 'ffff',
                        'tags' => [
                            'tag_1' => 'food',
                            'tag_2' => 'restaurant',
                        ],
                        'content' => '美味しい料理を楽しんできました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1619,
                        'lng' => 138.675982,
                        'imageUrls' => [
                            'imageUrl_1' => 'kkk.jpeg',
                            'imageUrl_2' => 'lll.jpeg',
                        ],
                        'author' => 'user1213',
                    ],
                    'Report_7' => [
                        'id' => 7,
                        'title' => 'gggg',
                        'tags' => [
                            'tag_1' => 'travel',
                            'tag_2' => 'adventure',
                        ],
                        'content' => '冒険的な旅行で楽しい時間を過ごしました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1591,
                        'lng' => 138.677381,
                        'imageUrls' => [
                            'imageUrl_1' => 'mmm.jpeg',
                            'imageUrl_2' => 'nnn.jpeg',
                        ],
                        'author' => 'user1415',
                    ],
                    'Report_8' => [
                        'id' => 8,
                        'title' => 'hhhh',
                        'tags' => [
                            'tag_1' => 'culture',
                            'tag_2' => 'art',
                        ],
                        'content' => '美術館で素晴らしいアートを鑑賞しました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1632,
                        'lng' => 138.678910,
                        'imageUrls' => [
                            'imageUrl_1' => 'ooo.jpeg',
                            'imageUrl_2' => 'ppp.jpeg',
                        ],
                        'author' => 'user1617',
                    ],
                    'Report_9' => [
                        'id' => 9,
                        'title' => 'iiii',
                        'tags' => [
                            'tag_1' => 'nature',
                            'tag_2' => 'outdoor',
                        ],
                        'content' => '自然の中でアウトドア活動を楽しんできました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1608,
                        'lng' => 138.681467,
                        'imageUrls' => [
                            'imageUrl_1' => 'qqq.jpeg',
                            'imageUrl_2' => 'rrr.jpeg',
                        ],
                        'author' => 'user1819',
                    ],
                    'Report_10' => [
                        'id' => 10,
                        'title' => 'jjjj',
                        'tags' => [
                            'tag_1' => 'food',
                            'tag_2' => 'cafe',
                        ],
                        'content' => 'カフェで美味しいコーヒーを楽しんできました。',
                        'address' => '静岡県富士市',
                        'lat' => 35.1584,
                        'lng' => 138.679621,
                        'imageUrls' => [
                            'imageUrl_1' => 'sss.jpeg',
                            'imageUrl_2' => 'ttt.jpeg',
                        ],
                        'author' => 'user2021',
                    ],
                ],
                'CoinLogs' =>[
                    'CoinLog_1' => [
                        'id' => 1,
                        'userId' => $user_id,
                        'amount' => 50,
                    ],
                    'CoinLog_2' => [
                        'id' => 2,
                        'userId' => $user_id,
                        'amount' => -20,
                    ],
                    'CoinLog_3' => [
                        'id' => 3,
                        'userId' => $user_id,
                        'amount' => 100,
                    ],
                    'CoinLog_4' => [
                        'id' => 4,
                        'userId' => $user_id,
                        'amount' => -10,
                    ],
                    'CoinLog_5' => [
                        'id' => 5,
                        'userId' => $user_id,
                        'amount' => 30,
                    ],
                ],
                'Favorites' =>[
                    'Favorite_1' => [
                        'userId' => $user_id,
                        'reportId' => '12',
                        'isFavorite' => true,
                    ],
                    'Favorite_2' => [
                        'userId' => $user_id,
                        'reportId' => '34',
                        'isFavorite' => false,
                    ],
                    'Favorite_3' => [
                        'userId' => $user_id,
                        'reportId' => '56',
                        'isFavorite' => true,
                    ],
                    'Favorite_4' => [
                        'userId' => $user_id,
                        'reportId' => '78',
                        'isFavorite' => true,
                    ],
                    'Favorite_5' => [
                        'userId' => $user_id,
                        'reportId' => '90',
                        'isFavorite' => false,
                    ],
                ],
                'Questions' =>[
                    'Question_1' => [
                        'id' => 1,
                        'prefecture' => '静岡県',
                        'city' => '富士市',
                        'author' => 'user2871',
                        'reward' => 100,
                        'content' => 'おすすめの飲食店教えてください',
                    ],
                    'Question_2' => [
                        'id' => 2,
                        'prefecture' => '静岡県',
                        'city' => '富士市',
                        'author' => 'user211',
                        'reward' => 50,
                        'content' => '美しい観光スポットを教えてください',
                    ],
                    'Question_3' => [
                        'id' => 3,
                        'prefecture' => '静岡県',
                        'city' => '富士市',
                        'author' => 'user1291',
                        'reward' => 200,
                        'content' => '近くのイベント情報を教えてください',
                    ],
                    'Question_4' => [
                        'id' => 4,
                        'prefecture' => '静岡県',
                        'city' => '富士市',
                        'author' => 'user2131',
                        'reward' => 150,
                        'content' => '子供と楽しめる施設を教えてください',
                    ],
                    'Question_5' => [
                        'id' => 5,
                        'prefecture' => '静岡県',
                        'city' => '富士市',
                        'author' => 'user21',
                        'reward' => 80,
                        'content' => 'おすすめの散歩コースを教えてください',
                    ],
                ],
            ];

            return response()->json($res, 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
    
    public function action_index_put(Request $request){
        
    }
}