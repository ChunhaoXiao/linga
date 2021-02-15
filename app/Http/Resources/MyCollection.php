<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-02 22:46:27
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'post' => new Post($this),
            'time' => $this->pivot->created_at->toDateTimeString()
           // 'comment_time' => 'asdsad',
        ];
    }
}
