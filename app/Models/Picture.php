<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable = ['nombre', 'tipo', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('student_id', 'DESC');
    }

    public function scopeId($query, $stu_id)
    {
        if ($stu_id)
            return $query->where('student_id', 'LIKE',"%$stu_id%");
    }

    public function scopeWithStudent($query, $student_id)
    {
        if ($student_id)
            return $query->with('student')
                ->where('student_id', '=', $student_id)->get();
    }

    public function scopeWithStu($query)
    {
        return $query->with('student');
    }

}
