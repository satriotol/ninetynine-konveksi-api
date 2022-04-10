<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'company', 'phone', 'email', 'user_id'];
    protected $appends = ['user_name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getUserNameAttribute()
    {
        return $this->user->name ?? "";
    }
}
