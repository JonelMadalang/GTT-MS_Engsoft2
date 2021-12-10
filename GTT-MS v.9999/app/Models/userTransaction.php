<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userTransaction extends Model
{
    protected $table = 'transactions';
    use HasFactory;
    protected $fillable=[
        'user_id',
        'date',
        'boundary',
        'bond',
        'expenses',
        'remarks',
        'status',
        'verified_by',
        'expenses_details'

    ];
}
