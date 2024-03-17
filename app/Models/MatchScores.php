<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchScores extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'match_scores';

    protected $fillable = ['match_between_team_id','score_a','score_b','player_left_a','player_left_b'];

    protected $with = ['matchBetweenTeams'];

    public function matchBetweenTeams()
    {
        return $this->hasOne(MatchBetweenTeams::class, 'id','match_between_team_id');
    }
}
