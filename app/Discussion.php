<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Discussion extends Model
{
    protected $fillable = [
        'title', 'content', 'slug', 'channel_id', 'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyname()
    {
        return 'slug'; //route model binding will use slug instead of id
    }
}
