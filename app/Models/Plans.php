<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    //
    protected $table = 'tb_plans';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'price',
        'is_paid'
    ];

    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class, 'fk_id_plan', 'id');
    }

}
