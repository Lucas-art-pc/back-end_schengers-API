<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function scopeVisibleTo($query, $user = null)
    {
        if (! $user?->plan?->has_access_paid_courses) {
            $query->where('is_paid', false);
        }

        return $query;
    }

    protected static function booted()
    {
        static::saving(function ($model) {

            if (!$model->public_id) {
                $model->public_id = (string) Str::uuid();
            }

            if ($model->isDirty('title_course')) {
                $model->slug_course = Str::slug($model->title_course);
            }
        });
    }


}
