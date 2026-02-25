<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ActivityCourse extends Model
{
    //

    protected $primaryKey = 'id_activity';
    protected $table = 'tb_activity';

    protected $fillable = [
      'id_activity',
      'title_activity',
      'public_id',
      'description_activity',
      'question_activity',
      'fk_id_course'
    ];

    public $timestamps = true;

    public function activities()
    {
        return $this->belongsTo(Course::class, 'fk_id_course', 'id_course');
    }

    protected static function booted()
    {
        static::saving(function ($model) {

            if (!$model->public_id) {
                $model->public_id = (string) Str::uuid();
            }

            if ($model->isDirty('title_activity')) {
                $model->slug_vacancy = Str::slug($model->title_activity);
            }
        });
    }
}
