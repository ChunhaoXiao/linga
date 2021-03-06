<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-09-20 21:13:46
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $withCount = [
        'files',
    ];

    protected $with = [
        'cover',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function files()
    {
        return $this->hasMany(PostPicture::class, 'post_id');
    }

    public function setBodyAttribute($v)
    {
        $this->attributes['body'] = trim(strlen($v)) < 5 ? $this->title : $v;
    }

    public function cover()
    {
        return $this->hasOne(PostPicture::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function comment()
    {
        return $this->hasOne(PostComment::class, 'post_id')->where('user_id', Auth::id())->latest();
    }

    public function histories()
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    //收藏 多对多
    public function users()
    {
        return $this->belongsToMany(User::class, 'collections');
    }

    public function feeds()
    {
        return $this->morphMany(Feed::class, 'feedable');
    }

    public function my_last_comment()
    {
        return $this->hasOne(PostComment::class, 'post_id')->where('user_id', Auth::id())->latest();
    }

    public function scopeVip($query)
    {
        if (Auth::user()->is_vip()) {
            return $query;
        }

        return $query->where('is_vip', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function is_video()
    {
        return pathinfo($this->cover->path ?? '', PATHINFO_EXTENSION) == 'mp4';
    }

    public function getCoverThumbAttribute()
    {
        if (empty($this->cover->path)) {
            return '';
        }
        if ($this->is_video()) {
            return asset('storage/'.$this->cover->path);
        }
        $file = pathinfo($this->cover->path);

        return asset('storage/'.$file['dirname'].'/'.$file['filename'].'_thumb.'.$file['extension']);
    }


    protected static function booted()
    {
        static::deleting(function ($post) {
            History::where('post_id', $post->id)->delete();
            PostComment::where('post_id', $post->id)->delete();
            Feed::where('related_post_id', $post->id)->delete();
            Like::where([['likeable_type', "App\Models\Post"], ['likeable_id', $post->id]])->delete();
            Collection::where('post_id', $post->id)->delete();
        });
    }

    // public function getCoverAttribute() {
    //     return asset('storage/'.$this->files[0]->path);
    // }
}
