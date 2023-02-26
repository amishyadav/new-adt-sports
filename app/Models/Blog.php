<?php

namespace App\Models;

use App\Models\Contracts\JsonResourceful;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $with = ['media'];

    protected $fillable = [
        'slug',
        'tag',
        'title',
        'description',
    ];

    const IMAGE = 'image';
    protected $appends = ['blog_image'];

    public function getBlogImageAttribute(): string
    {
        $media = $this->getMedia(self::IMAGE)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('images/avatar.png');
    }
}
