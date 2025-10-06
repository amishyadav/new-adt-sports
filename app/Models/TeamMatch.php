<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatch extends Model
{

    protected $fillable = [
        'team1_id',
        'team2_id',
        'status',
    ];

    public function team1()
    {
        return $this->belongsTo(Teams::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Teams::class, 'team2_id');
    }
}
