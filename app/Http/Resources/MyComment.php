<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-02 21:27:19
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyComment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'post' => new Post($this),
            'time' => !empty($this->my_last_comment->created_at)? $this->my_last_comment->created_at->toDateTimeString():'',
        ];
    }
}
