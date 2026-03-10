<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    //
    protected $table = 'tb_student_answers';
    protected $fillable = ['fk_id_student', 'fk_id_activity', 'fk_id_alternative'];
}
