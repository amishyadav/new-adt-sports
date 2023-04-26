<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeSlider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $with = ['media'];

    protected $fillable = [
        'main_title',
        'title',
    ];

    const SLIDER_IMAGE = 'slider_image';
    protected $appends = ['slider_image'];

    public function getSliderImageAttribute(): string
    {
        $media = $this->getMedia(self::SLIDER_IMAGE)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('images/avatar.png');
    }
}
