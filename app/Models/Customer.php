<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function getCustomerPaginate()
    {
        if (Auth::user()->role->name == 'user') {
            return $this->where('user_id', Auth::user()->id)->paginate(10);
        } else {
            return $this->paginate(10);
        }
    }
    public function getCustomer()
    {
        if (Auth::user()->role->name == 'user') {
            return $this->where('user_id', Auth::user()->id)->get(['id', 'name']);
        } else {
            return $this->all(['id', 'name']);
        }
    }
}
