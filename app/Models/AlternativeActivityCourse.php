<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternativeActivityCourse extends Model
{
    //


    protected $table = 'tb_alternative';
    protected $primaryKey = 'id_alternative';

    protected $fillable = [
        'id_alternative',
        'title_alternative',
        'text_alternative',
        'correct_alternative',
        'fk_id_activity',
    ];

    public $timestamps = false;

    protected $casts = [
        'correct_alternative' => 'boolean',
    ];

    public function activity()
    {
        return $this->belongsTo(ActivityCourse::class, 'fk_id_activity', 'id_activity');
    }

}
