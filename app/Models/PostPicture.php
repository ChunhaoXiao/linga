<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPicture extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getIsVideoAttribute() {
        $ext = pathinfo($this->path, PATHINFO_EXTENSION);
        return in_array($ext, ['mp4', 'flv']);
    }

    public function getFullPath() {
        return asset('storage/'.$this->path);
    }
}
