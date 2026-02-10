<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vacancy extends Model
{
    //

    protected $table = 'tb_vacancy';

    protected $primaryKey = 'id_vacancy';

    protected $fillable = [
        'id_vacancy',
        'fk_id_area',
        'public_id',
        'title_vacancy',
        'description_vacancy',
        'requirements_vacancy',
        'tasks_vacancy',
        'slug_vacancy',
        'status_vacancy',
        'start_date_vacancy',
    ];

    public $timestamps = false;

    public function area(){
        return $this->belongsTo(Area::class, 'fk_id_area');
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->public_id) {
                $model->public_id = (string) Str::uuid();
            }

            if (!$model->slug_vacancy) {
                $model->slug_vacancy = Str::slug($model->title_vacancy);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }
}
