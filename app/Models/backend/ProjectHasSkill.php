<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Projects;

class ProjectHasSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'skill_name'
    ];
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
}
