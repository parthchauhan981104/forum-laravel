<?php

namespace App;

use App\User;
use App\Reply;
use App\Notifications\ReplyMarkedAsBestReply;

class Discussion extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyname()
    {
        return 'slug'; //route model binding will use slug instead of id
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);

        if ($reply->user->id !== $this->author->id) {
            $reply->user->notify(new ReplyMarkedAsBestReply($reply->discussion));
        }
    }

    public function unmarkAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => null
        ]);
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($query) //a chainable method to the queryBuilder
    {
        if (request()->query('channel')) {
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if ($channel) {
                return $query->where('channel_id', $channel->id);
            }
        }

        return $query;
    }
}
