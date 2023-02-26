<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Partner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = [
        'name',
    ];
    protected $with = ['media'];
    const IMAGE = 'bottom_image';
    protected $appends = ['image'];

    public function getImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::IMAGE)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('images/avatar.png');
    }
}
