<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewspaperSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'newspaper_title' => 'THE CICI TIMES',
            'birthday_girl_name' => 'Cici',
            'age' => '24',
            'edition_motto' => "All The Joy That's Fit To Celebrate",
            'left_ear_text' => "Special Commemorative Edition • Vol. XXIV No. 1 • Collector's Issue",
            'right_ear_text' => 'Forecast: 100% Sunshine, Laughter & Confetti',
            'breaking_ticker' => "BREAKING: Global Celebrations Underway for Cici's 24th Birthday! • Historic Milestones Ahead • Outpouring of Love Reported Worldwide",
            'issue_date' => 'Thursday, August 20, 2026',
            'price' => '$2.00 / PRICELESS',
            'volume_number' => 'VOL. CLXXV... No. 59,880',
            'audio_title' => 'Birthday Serenade & Loved Ones Toast',
            'audio_url' => 'https://actions.google.com/sounds/v1/ambiences/coffee_shop.ogg',
            'admin_pin' => '1234',
        ]);
    }

    protected function getIssueDateAttribute($value)
    {
        return now()->format('l, F j, Y');
    }

    protected function getAgeAttribute($value)
    {
        return (string) \Carbon\Carbon::parse('2003-08-25')->age;
    }

    protected function getAudioUrlAttribute($value)
    {
        return format_gdrive_url($value);
    }

    protected function setAudioUrlAttribute($value)
    {
        $this->attributes['audio_url'] = format_gdrive_url($value);
    }
}
