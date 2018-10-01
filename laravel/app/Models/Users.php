<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['name', 'email', 'password', 'image'];

    public function messages()
    {
        return $this->belongsToMany(Messages::class);
    }
}
