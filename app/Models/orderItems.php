<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'client_id',
        'user_id',
        'product_id',
        'product_code',
        'product_name',
        'purchase_price',
        'sell_price',
        'product_qty',
        'earnings'
    ];
}
