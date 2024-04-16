<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'invoice_tracking',
        'payment_status',
        'invoice_price',
        'paid_price',
    ];

    public function getItems(){
      return  $this->hasMany(supplierInvoiceItems::class,'invoice_id');
    }
    public function getSupplier(){
      return  $this->belongsTo(suppliers::class,'supplier_id','id');
    }

}
