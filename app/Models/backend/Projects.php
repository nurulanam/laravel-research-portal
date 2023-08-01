<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\ProjectHasCity;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\ProjectHasProjectTopic;
use App\Models\backend\ProjectHasIndustry;

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
    public function responses()
    {
        return $this->hasMany(ProjectHasResponse::class, 'project_id', 'id');
    }
    public function projectTopic()
    {
        return $this->hasMany(ProjectHasProjectTopic::class, 'project_id', 'id');
    }
    public function projectIndustires()
    {
        return $this->hasOne(ProjectHasIndustry::class, 'project_id', 'id');
    }
    public function companySizes()
    {
        return $this->hasOne(ProjectHasCompanySize::class, 'project_id', 'id');
    }
}
