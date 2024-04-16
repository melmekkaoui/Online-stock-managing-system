<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_unit',
        'product_code',
        'product_designation',
        'product_qty',
        "purchase_price",
        "sell_price",
        "Created_by",
        "cart_number",
        "subtotal"
    ];
}
