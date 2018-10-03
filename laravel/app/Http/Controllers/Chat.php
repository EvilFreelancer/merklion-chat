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
}
