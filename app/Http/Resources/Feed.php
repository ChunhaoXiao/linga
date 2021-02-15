<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Feed extends JsonResource
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
        // return parent::toArray($request);
        return [
           'action' => $this->action,
           'reply_content' => $this->feedable->body??'',
           'replied_content' => $this->comment->body ?? '',
           'post' => $this->post ? new Post($this->post) : '',
           'from' => $this->user,
           'time' => $this->created_at->toDateTimeString(),
           'related_comment_id' => $this->related_comment_id,
           'like_type' => $this->feedable_type == 'App\Models\PostComment' ? 'comment' : 'post',
           // 'to' => $this->to_user,
       ];
    }
}
