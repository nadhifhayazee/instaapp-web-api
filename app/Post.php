<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'user_id','caption','post_image'
    ];

    protected $appends = [
        'isLiked'
    ];

    public function getIsLikedAttribute()
    {
       $like =  $this->likes()->where('user_id', Auth::user()->id)->first();
       if ($like == null) return false;
       return true;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    // public function likes(){
    //     return $this->belongsToMany(Post::class, 'App\Like', 'post_id', 'post_id');
    // }

    public function likes(){
        return $this->hasMany('App\Like');
    }


}
