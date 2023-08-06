<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Skill;

class userHasSkills extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'skills',
    ];

}
