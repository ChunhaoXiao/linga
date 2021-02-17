<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Post $post) 
    {
        if(!$post->is_vip) {
            return true;
        }
        return $user->is_vip() || $user->manager()->exists();
    }
}
