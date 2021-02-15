<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
        $data = parent::toArray($request);
        $data['is_vip'] = $this->is_vip();
        $data['vip_due_date'] = $this->vip_due_date();
        $data['has_new_feed'] = $this->related_me()->unread()->exists();

        return $data;
    }
}
