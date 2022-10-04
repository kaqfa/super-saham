<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SahamPrices extends Model
{
    use HasFactory;
    protected $fillable = ['symbol', 'last_date', 'open', 'close', 
                           'low', 'high', 'adjClose', 'volume'];
}
