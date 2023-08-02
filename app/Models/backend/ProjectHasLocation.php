<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHasLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'locations'
    ];
}
