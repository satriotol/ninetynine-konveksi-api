<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OrderImage extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('storage/'. $this->image);
    }
    public function deleteImage()
    {
        Storage::disk('public')->delete($this->attributes['image']);
    }
}
