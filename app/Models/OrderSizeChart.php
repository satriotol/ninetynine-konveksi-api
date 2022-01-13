<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OrderSizeChart extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'file'];
    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return url('storage/'. $this->file);
    }
    public function deleteFile()
    {
        Storage::disk('public')->delete($this->attributes['file']);
    }
}
