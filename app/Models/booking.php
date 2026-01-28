<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'pick_date',
        'pick_time',
        'return_date',
        'return_time',
        'pic_loc',
        'return_loc',
        'car_id',
        'user_id',
        'pay_method',
        'pay_id',
        'pay_status',
        'status',
    ];

}
