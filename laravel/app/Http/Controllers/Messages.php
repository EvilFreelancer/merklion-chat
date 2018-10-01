<?php

namespace App\Http\Controllers;

use App\Models\Messages as MessagesModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Messages
{
    public function create(Request $request)
    {
        $body = $request->all();
        $defaults = ['user_id' => \Auth::user()->id];
        $message = array_merge($defaults, $body);

        if (MessagesModel::create($message)) {
            $message['username'] = \Auth::user()->name;
        } else {
            $message = null;
        }

        return $message;
    }

    public function get($room_id)
    {
        return MessagesModel::select(['messages.*', 'u.name as username'])
            ->orderBy('created_at', 'desc')
            ->where(['room_id' => $room_id])
            ->leftjoin('users as u', 'u.id', '=', 'messages.user_id')
            ->limit(8)->get();
    }

}
