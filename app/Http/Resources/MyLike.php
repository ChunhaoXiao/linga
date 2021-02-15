<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-02 22:15:19
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyLike extends JsonResource
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
            'post' => new Post($this->likeable),
            'time' => (string)$this->updated_at,
        ];
    }
}
