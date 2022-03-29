<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'nominal'];
    protected $appends = ['order_name'];
    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function getOrderNameAttribute()
    {
        return $this->order->title ?? "";
    }
}
