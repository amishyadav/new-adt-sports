<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    protected $with = ['user'];

    const ACTIVE = 1;
    const INACTIVE = 0;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' ,  'id');
    }
}
