<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id',
        'add_by_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' ,  'id');
    }

}
