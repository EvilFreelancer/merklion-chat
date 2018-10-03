<?php

namespace App\Http\Controllers;

use App\Models\Messages as MessagesModel;
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
            $message['email'] = \Auth::user()->email;
            $message['avatar'] = $this->fixPath(\Auth::user()->avatar);
        } else {
            $message = null;
        }

        return $message;
    }

    /**
     * Fix from public to storage
     *
     * @param   string $path
     * @return  null|string|string[]
     */
    private function fixPath(string $path = null)
    {
        return preg_replace('/^public\//', '/storage/', $path);
    }

    public function get($room_id)
    {
        $messages = MessagesModel::select(['messages.*', 'u.name as username', 'u.email', 'u.avatar'])
            ->orderBy('created_at', 'desc')
            ->where(['room_id' => $room_id])
            ->leftjoin('users as u', 'u.id', '=', 'messages.user_id')
            ->limit(8)->get()->toArray();

        return array_map(
            function($message) {
                $message['avatar'] = $this->fixPath($message['avatar']);
                return $message;
            },
            $messages
        );
    }

}
