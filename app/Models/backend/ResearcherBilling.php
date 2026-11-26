<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearcherBilling extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'project_id',
        'response_code',
        'auth_code',
        'transaction_id',
    ];
    public function project(){
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
}
