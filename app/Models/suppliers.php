<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'supplier_phone',
        'supplier_adr',
        'supplier_balance'
    ];
}
