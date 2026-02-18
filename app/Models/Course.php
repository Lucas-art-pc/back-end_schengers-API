<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    use HasFactory;

    protected $table = 'tb_courses';
    protected $primaryKey = 'id_course';

    protected $fillable = [
        'id_course',
        'fk_id_area',
        'public_id',
        'fk_id_teacher',
        'title_course',
        'slug_course',
        'description_course',
        'duration_course',
        'active_course',
        'is_paid'
    ];

    public $timestamps = true;

    public function area()
    {
        return $this->belongsTo(Area::class, 'fk_id_area');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'fk_id_teacher');
    }


}
