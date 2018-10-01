<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = ['room_id', 'user_id', 'body'];

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
