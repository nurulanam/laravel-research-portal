<?php

namespace App\Models\backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHasMessage extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'project_id',
      'message'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
