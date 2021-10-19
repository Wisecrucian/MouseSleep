<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'id', 'theme', 'message',  'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
