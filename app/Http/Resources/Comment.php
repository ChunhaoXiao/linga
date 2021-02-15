<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-12-27 22:09:25
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'content' => $this->body,
            'created' => $this->created_at,
            'likes' => $this->likes_count,
            'mylike' => $this->mylike_count,
            'post_id' => $this->post_id,
            'reply_to' => $this->comment->user->name ?? '',
        ];
    }
}
