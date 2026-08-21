<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
        'order_num' => 'integer',
    ];

    public function scopeZone($query, string $zone)
    {
        return $query->where('layout_zone', $zone)->orderBy('order_num', 'asc')->orderBy('created_at', 'desc');
    }

    protected function getImageUrlAttribute($value)
    {
        return format_gdrive_url($value);
    }

    protected function setImageUrlAttribute($value)
    {
        $this->attributes['image_url'] = format_gdrive_url($value);
    }
}
