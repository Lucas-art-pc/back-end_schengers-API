<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'tb_teacher';
    protected $fillable = [
        'id',
        'name',
        'email',
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
