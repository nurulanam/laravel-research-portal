<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\ProjectHasCity;

class Projects extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'my_project_name',
        'study_title',
        'study_description',
        'target_audience',
        'project_type',
        'research_type',
        'required_time',
        'participant_incentive',
        'target_participant',
        'total_incentive',
        'total_service_fee',
        'total_coast',
        'status',
        'published_at'
    ];

    public function projectHasCities(){
        return $this->hasMany(ProjectHasCity::class, 'project_id');
    }
}
