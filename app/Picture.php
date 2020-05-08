<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable=['nombre','tipo','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
