<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHasIndustry extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'industries'
    ];
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
}
