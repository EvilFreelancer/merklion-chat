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
        return MessagesModel::create(array_merge($defaults, $body));
    }
}
