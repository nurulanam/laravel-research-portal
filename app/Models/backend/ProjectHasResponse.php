<?php

namespace App\Models\backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Projects;

class ProjectHasResponse extends Model
{
    use HasFactory;
    protected $fillable =[
        'project_id',
        'user_id',
        'user_response'
    ];
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
