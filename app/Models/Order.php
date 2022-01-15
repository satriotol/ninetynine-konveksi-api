<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'customer_id', 'user_id', 'note', 'start_date', 'end_date'];

    protected $appends = ['total_price', 'total_payment', 'total_money', 'status', 'customer_name'];

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
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->name ?? "";
    }
    public function getUserNameAttribute()
    {
        return $this->user->name ?? "";
    }

    public function getTotalPriceAttribute()
    {
        return $this->order_details()->sum('total_price') ?? 0;
    }

    public function getTotalPaymentAttribute()
    {
        return $this->order_payments()->sum('nominal') ?? 0;
    }

    public function getTotalMoneyAttribute()
    {
        return $this->total_price - $this->total_payment;
    }
    public function getStatusAttribute()
    {
        if ($this->total_money > 0) {
            return "Belum Lunas";
        } else {
            return "Lunas";
        }
    }
}
