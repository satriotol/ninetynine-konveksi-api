<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'customer_id', 'user_id', 'note', 'start_date', 'end_date'];

    public function order_payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id');
    }
    public function order_images()
    {
        return $this->hasMany(OrderImage::class, 'order_id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function order_size_charts()
    {
        return $this->hasMany(OrderSizeChart::class, 'order_id');
    }
}
