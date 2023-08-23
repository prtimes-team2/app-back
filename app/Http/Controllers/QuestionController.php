<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function action_index(Request $request){
        try{
            return response()->json([], 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $errorResponse = $e->getResponse();
            $errorContent = $errorResponse->getBody()->getContents();
            return response()->json(json_decode($errorContent, true), $errorResponse->getStatusCode());
        }
    }
}
