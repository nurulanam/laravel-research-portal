<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'user_avatar',
        'gender',
        'date_of_birth',
        'phone',
        'country',
        'city',
        'zip_code',
        'job_title',
        'company_name',
        'company_size',
        'ethnicity',
        'education_level',
        'employment_status',
        'household_income',
        'marital_status',
        'children_in_living',
        'status',
    ];
}
