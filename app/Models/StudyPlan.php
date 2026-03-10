<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyPlan extends Model
{
    //

    protected $fillable = [
        'fk_id_student',
        'day_of_week_study_plan',
        'activity_study_plan',
        'description_study_plan',
        'duration_study_plan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
