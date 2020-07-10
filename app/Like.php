<?php

namespace App;

use App\Reply;
use App\User;

class Like extends Model
{
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
