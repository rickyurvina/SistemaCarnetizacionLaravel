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
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
