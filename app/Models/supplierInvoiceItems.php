<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierInvoiceItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'product_name',
        'product_qty',
        'product_price',
        'Created_by'
    ];
}
