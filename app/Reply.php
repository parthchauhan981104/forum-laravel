<?php

namespace App;
use App\User;
use App\Discussion;
use App\Like;


class Reply extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuthUser()
    {
        $id = auth()->user()->id;

        $likers = array();

        foreach($this->likes as $like):
            array_push($likers, $like->user_id);
        endforeach;


        return in_array($id, $likers);
    }

}
