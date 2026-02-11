<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    //

    protected $table = 'tb_curriculum';
    protected $primaryKey = 'id_curriculum';

    protected $fillable = [
        'id_curriculum',
        'fk_id_teacher',
        'fk_id_vacancy',
        'name',
        'email',
        'phone',
        'linkedin',
        'portfolio',
        'education_level',
        'institution',
        'course',
        'graduation_year',
        'professional_experience',
        'skills',
        'personal_document',
        'professional_experience',
        'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'fk_id_teacher');
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class, 'fk_id_vacancy');
    }
}
