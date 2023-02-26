<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQs extends Model
{
    use HasFactory;
    
    protected $table = 'faqs';
    
    protected $fillable = [
        'question',
        'answer',
        'status',
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;
}
