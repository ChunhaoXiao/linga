<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'type',
        'used_at',
        'user_id',
    ];

    public function scopeFilter($query, $data)
    {
        if (empty($data)) {
            return $query;
        }
        $fields = ['card_number', 'type'];
        foreach ($data as $k => $v) {
            if (in_array($k, $fields)) {
                $query = $query->where($k, $v);
            }
        }

        return $query;
    }

    public function getVipMonthAttribute() {
        $types = [
            1 => 1, 
            2 => 3, 
            3 => 12
        ];
        return $types[$this->type] ?? 1;
    }
}
