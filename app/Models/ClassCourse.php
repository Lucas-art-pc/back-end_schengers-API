<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClassCourse extends Model
{
    //
    protected $table = 'tb_class';
    protected $primaryKey = 'id_class';

    protected $fillable = [
        'id_class',
        'title_class',
        'public_id',
        'slug_class',
        'description_class',
        'explication_class',
        'duration_class',
        'url_class',
        'fk_id_course'
    ];

    public $timestamps = true;

    public function course()
    {
        return $this->belongsTo(Course::class, 'fk_id_course', 'id_course');
    }


    protected static function booted()
    {
        static::saving(function ($model) {

            if (!$model->public_id) {
                $model->public_id = (string) Str::uuid();
            }

            if ($model->isDirty('title_class')) {
                $model->slug_class = Str::slug($model->title_class);
            }
        });
    }
}
