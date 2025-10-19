<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatchScore extends Model
{
    protected $table = 'team_match_scores';

    protected $fillable = [
        'team_match_id',
        'team1_score',
        'team2_score',
        'team1_player_left',
        'team2_player_left',
        'court_swap',
        'team1_total_raid',
        'team2_total_raid',
        'main_seconds',
        'raid_seconds',
        'main_running',
        'raid_running',
        'user_id'
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
