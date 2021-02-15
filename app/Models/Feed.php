<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-03 16:59:45
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function feedable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user')->withDefault();
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'related_post_id')->withDefault();
    }

    public function comment()
    {
        return $this->belongsTo(PostComment::class, 'related_comment_id');
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('viewed');
    }
}
