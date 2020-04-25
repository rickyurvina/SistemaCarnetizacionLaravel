<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable=['CUR_NOMBRE','CUR_PARALELO','institution_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
//        return $this->hasMany(Institution::class);
    }
    public function course(){

    }
}
