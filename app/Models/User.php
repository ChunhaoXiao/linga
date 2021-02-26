<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-09-20 13:10:43
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'open_id', 'mobile', 'bod', 'mobile', 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['uname'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'started_at',
        'ended_at',
    ];

    public function histories()
    {
        return $this->hasMany(History::class, 'user_id');
    }

    public function updateViewHistory($post)
    {
        $row = $this->histories()->where('post_id', $post->id)->first();
        if ($row) {
            return $row->touch();
        }

        return $this->histories()->create(['post_id' => $post->id]);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function vips()
    {
        return $this->hasMany(VipMemeber::class, 'user_id');
    }

    public function vip()
    {
        return $this->hasOne(VipMemeber::class)->where('ended_at', '>', now())->limit(1);
    }

    public function is_vip()
    {
        return $this->vips()->where('ended_at', '>', now())->exists();
    }

    public function vip_due_date()
    {
        $data = $this->vips()->where('ended_at', '>', now())->first();
        if ($data) {
            return $data->ended_at->toDateString();
        }

        return '';
    }

    //收藏 多对多
    public function collection_posts()
    {
        return $this->belongsToMany(Post::class, 'collections')->withTimestamps()->withPivot('created_at')->orderBy('collections.created_at', 'desc');
    }

    public function feeds()
    {
        return $this->hasMany(Feed::class, 'from_user');
    }

    public function related_me()
    {
        return $this->hasMany(Feed::class, 'to_user');
    }

    public function createLikeFeed($object)
    {
        if (!empty($object->user->id)) {
            $data = $object->feeds()->make([
                'to_user' => $object->user->id,
                'action' => 'like',
                'related_post_id' => $object->post->id ?? $object->id,
            ]);
            $this->feeds()->save($data);
        }
    }

    public function deleteLikeFeed($object)
    {
        if (!empty($object->user->id)) {
            $object->feeds()->where([
                ['from_user', $this->id],
                ['to_user', $object->user->id],
            ])->delete();
        }
    }

    public function createCommentFeed()
    {
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function manager()
    {
        return $this->hasOne(ManagerUser::class, 'user_id');
    }

    public function getUnameAttribute()
    {
        if (!empty($this->name)) {
            return $this->name;
        }

        return '用户_'.$this->id;
    }
}
