<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;
    protected $fillable=[
        "fname",
        "lname",
        "phone_number",
        "Created_by",
        "adresse",
    ];

}
