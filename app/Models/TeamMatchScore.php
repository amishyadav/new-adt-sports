<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatchScore extends Model
{
    protected $table = 'team_match_scores';

    protected $fillable = [
        'team1_id',
        'team2_id',
        'team1_score',
        'team2_score',
        'user_id'
    ];

    public function team1()
    {
        return $this->belongsTo(Teams::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Teams::class, 'team2_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id' ,  'user_id');
    }
}
