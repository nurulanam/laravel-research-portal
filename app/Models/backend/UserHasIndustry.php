<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasIndustry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'industry',
    ];
}
