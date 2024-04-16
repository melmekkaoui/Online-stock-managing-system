<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'discount',
        'merchant',
        'order_price',
        'payed_price',
        'payment_method',
        'is_payed',
        'tracking_number',
    ];
     public function orderItems()
    {
        return $this->hasMany(orderItems::class,'order_id','id');
    } 

}
