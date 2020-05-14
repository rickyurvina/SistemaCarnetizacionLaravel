<?php

namespace App\Models;

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
    public function scopeCourseIns($query, $id){
        if ($id)
        {
            return $query->where('institution_id',$id);
        }
    }
    public function scopeWithStudent($query)
    {
        return $query->with('student');
    }

    public function scopeCourseID($query,$id)
    {
        if ($id)
        {
            return $query->where('id','=',$id)->get();
        }
    }
    public function scopePluckName($query)
    {
        return $query->pluck('CUR_NOMBRE','id');
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('institution_id','DESC');
    }
}
