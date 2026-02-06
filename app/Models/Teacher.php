<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{

    use HasFactory, HasApiTokens;

    protected $table = 'tb_teacher';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'role',
        'status',
        'apresentation',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
