<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class TestController extends Controller
{
    public function action_index(Request $request){
        $user = User::find('1');
        $data = [
            'User' => [
                'id' => $user->id,
                'line_id' => $user->line_id,
                'DisplayName' => $user->DisplayName,
                'ProfileImageUrl' => $user->ProfileImageUrl,
                'prefecture' => $user->prefecture,
                'city' => $user->city,
                'birth' => $user->birth,
                'gender' => 2,
            ]
        ];
        try{
            return response()->json($data, 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
