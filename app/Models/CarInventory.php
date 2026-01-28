<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInventory extends Model
{
    use HasFactory;

    protected $table = 'car_inventories';

    // protected $fillable = [
    //     'car_make',
    //     'car_model',
    //     'car_deg_no',
    //     'car_mileage',
    //     'car_type',
    // ];
}
