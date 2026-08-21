<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TributeMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected function getPhotoUrlAttribute($value)
    {
        return format_gdrive_url($value);
    }

    protected function setPhotoUrlAttribute($value)
    {
        $this->attributes['photo_url'] = format_gdrive_url($value);
    }
}
