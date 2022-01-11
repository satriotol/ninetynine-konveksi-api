<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'qty', 'total_price'];
    
    protected $appends = ['product_name'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
}
