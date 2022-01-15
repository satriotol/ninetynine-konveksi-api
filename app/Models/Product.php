<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'start_price'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url('storage/'. $this->image);
        }else{
            return url(asset('no-image.png'));
        }
    }
    public function deleteImage()
    {
        Storage::disk('public')->delete($this->attributes['image']);
    }
}
