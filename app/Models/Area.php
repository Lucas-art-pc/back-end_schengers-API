<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //

    protected $table = 'tb_areas';

    protected $fillable = [
        'id',
        'name_area',
        'slug_area',
        'icon_area',
        'color_area',
    ];

    public $timestamps = true;

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

}
