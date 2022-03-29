<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'start_price'];

    protected $appends = ['image_url', 'total_order'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        } else {
            return url(asset('no-image.png'));
        }
    }
    public function deleteImage()
    {
        Storage::disk('public')->delete($this->attributes['image']);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function getTotalOrderAttribute()
    {
        return $this->order_details()->sum('qty') ?? "";
    }
}
