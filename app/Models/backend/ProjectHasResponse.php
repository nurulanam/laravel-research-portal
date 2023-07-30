<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHasResponse extends Model
{
    use HasFactory;
    protected $fillable =[
        'project_id',
        'user_id',
        'user_response',
        'qualification'
    ];
}
