<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    protected $table = 'taxi';
    use HasFactory;
    protected $fillable=[
        'model',
        'plate_number',
        'boundary',
    
    ];

    protected $attributes = [
        'status' => 0,
    ];


}
