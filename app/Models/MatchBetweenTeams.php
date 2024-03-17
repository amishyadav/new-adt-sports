<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchBetweenTeams extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'match_between_teams';

    protected $fillable = ['team_a','team_b'];

    public function matchScores()
    {
        return $this->hasMany(MatchScores::class, 'match_between_team_id','id');
    }
}
