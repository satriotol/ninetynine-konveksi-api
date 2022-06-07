<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    protected $appends = ['total_order'];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function getTotalOrderAttribute()
    {
        return $this->order_details()->sum('qty') ?? "";
    }
}
