<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'title' => $this->title,
            //'cover' => $this->cover,
            //'files' => $this->files,
            'cover' => $this->cover_thumb, //!empty($this->cover) ? asset('storage/'.$this->cover->path) : '',
            'files' => $this->files->map->getFullPath(),
            'created_at' => $this->created_at ? $this->created_at->toDateString() : '',
            'file_count' => $this->files_count,
            'likes' => $this->likes()->count(),
            'mylike' => $this->likes()->where('user_id', $request->user()->id)->exists(),
            'collections' => $this->users()->count(),
            'mycollection' => $this->users()->where('user_id', $request->user()->id)->exists(),
            'comment_count' => $this->comments()->count(),
            'is_video' => $this->is_video(),
        ];
    }
}
