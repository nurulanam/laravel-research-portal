<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizeCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'profile_id',
        'payment_id',
        'card_digit'
    ];
}
