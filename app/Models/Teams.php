<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Teams extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'teams';

    protected $fillable = [
        'user_id',
        'name',
        'status'
    ];

    protected $with = ['media'];
    protected $appends = ['team_logo'];
    const TEAM_LOGO = 'team_logo';

    public function getTeamLogoAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::TEAM_LOGO)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('images/logo.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id' ,  'user_id');
    }
}
