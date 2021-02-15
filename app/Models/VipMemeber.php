<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-09 23:06:03
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipMemeber extends Model
{
    use HasFactory;

    protected $dates = [
        'started_at',
        'ended_at',
    ];
}
