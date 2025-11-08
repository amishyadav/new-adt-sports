<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_match_id',
        'main_timer_seconds',
        'raid_timer_seconds',
        'active_side',
        'user_id',
    ];

    public function teamMatch()
    {
        return $this->belongsTo(TeamMatch::class, 'team_match_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id' ,  'user_id');
    }
}
