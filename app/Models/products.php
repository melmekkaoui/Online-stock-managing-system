<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable=[
            'section_id',
            'unit_id',
            'experation_date',
            'product_designation',
            'product_qty'   ,
            'critical_qty'  ,
            'purchase_price'  ,
            'sell_price'      ,
            'code1',
            'code2',
            'code3',
            'code4',
            'code5',
            'code6',
            'code7',
            'code8', 
    ];
    public function getsection()
    {
        return $this->belongsTo(sections::class,'section_id','id');
    }
    public function getunit(){
        return $this->belongsto(units::class,'unit_id','id');
    }
}
