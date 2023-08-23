<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function action_index(Request $request){
        try{
            return response()->json([], 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return response()->json([], 200);
        }
    }
}
