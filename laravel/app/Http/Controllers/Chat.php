<?php

namespace App\Http\Controllers;

use Request;
use Redis;

class Chat extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send()
    {
        $redis = Redis::connection();
        $data = ['message' => Request::input('message'), 'user' => Request::input('user')];
        $redis->publish('message', json_encode($data));
        return response()->json([]);
    }
}
