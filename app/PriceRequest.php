<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceRequest extends Model
{
    protected $fillable = [
        'items', 'descriptions','quantity','units','price','cost'
    ];
}
