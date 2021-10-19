<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visible extends Model
{

    protected $fillable = [
        'id', 'post_id',  'user_id',
    ];

    public function visibility()
    {
        return $this->belongsTo(UserInfo::class);
    }
}
