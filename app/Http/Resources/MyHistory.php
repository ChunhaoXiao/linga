<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-12-19 21:55:11
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
           'post' => new Post($this->post),
           'time' => (string)$this->updated_at,
        ];
    }
}
