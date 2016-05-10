<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $fillable = [
        'bill_type', 'month', 'amount','date_pay'
    ];
}
