<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTypes extends Model
{
    use HasFactory;

    protected $table = 'car_types';

    protected $fillable = [
        'name',
        'description',
        'extras',
        'price_per_day',
        'price_per_hour',
    ];
}
