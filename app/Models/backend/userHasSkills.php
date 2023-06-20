<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userHasSkills extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'skill_id',
    ];
}
