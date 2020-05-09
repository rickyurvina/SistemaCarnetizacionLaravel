<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable=['nombre','tipo','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('student_id','DESC');
    }

    public function scopeId($query,$stu_id)
    {
        if ($stu_id)
            return $query->where('student_id',$stu_id);
    }

}
