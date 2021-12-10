<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable=[
        'fullname',
        'plate_number',
        'mobile_number',
        'taxi_model'
    ];
}
