<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSizeChart extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'file'];
}
