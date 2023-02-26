<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AllMatch
 *
 * @property int $id
 * @property string $match_title
 * @property int $league_id
 * @property string|null $start_from
 * @property string|null $end_at
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\League $league
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereMatchTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereStartFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AllMatch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AllMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_title',
        'league_id',
        'start_from',
        'end_at',
        'status',
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;

    /**
     *
     * @return BelongsTo
     */
    public function league()
    {
        return $this->belongsTo(League::class, 'league_id','id');
    }
    
    
}
