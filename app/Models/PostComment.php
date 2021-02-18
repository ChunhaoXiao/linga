<?php
/*
 * @Description: rm
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-09-29 21:47:43
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PostComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function mylike()
    {
        return $this->morphOne(Like::class, 'likeable')->where('user_id', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function feeds()
    {
        return $this->morphMany(Feed::class, 'feedable');
    }

    public function comment()
    {
        return $this->belongsTo(PostComment::class, 'comment_id')->withDefault();
    }

    // public function my_comments() {
    //     return $this->hasMany(PostComment:class)->latest()->groupBy();
    // }
}
