<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable=['CUR_NOMBRE','CUR_PARALELO','institution_id'];
}
