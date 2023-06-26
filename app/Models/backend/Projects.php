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
        'internal_name',
        'project_title',
        'project_details',
        'audience',
        'research_type',
        'research_method',
        'required_time',
        'incentive',
        'target_participant',
        'total_incentive',
        'total_service_fee',
        'total_coast',
        'status',
    ];

    public function projectHasCities(){
        return $this->hasMany(ProjectHasCity::class, 'project_id');
    }
}
