<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Projects;

class ProjectHasResponse extends Model
{
    use HasFactory;
    protected $fillable =[
        'project_id',
        'user_id',
        'user_response',
        'qualification'
    ];
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
}
