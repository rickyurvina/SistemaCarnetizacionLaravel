<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable=['INS_NOMBRE','INS_DIRECCION','INS_TELEFONO','INS_CELULAR','INS_TIPO','INS_MISION','INS_VISION'];

    public function course(){
        return $this->hasMany(Course::class);
    }

    public function background(){
        return $this->hasMany(Background::class);
    }

    public function logo(){
        return $this->hasOne(Logo::class);
    }

    public function person(){
        return $this->hasOne(Person::class);
    }

    public function student(){
        return $this->hasOne(Person::class);
    }
    public function scopeOrderCreate($query)
    {
        return $query->orderBy('INS_NOMBRE','ASC');
    }

    public function scopeName($query, $name)
    {
        if ($name)
            return $query->where('INS_NOMBRE','LIKE',"%$name%");
    }

    public function scopeType($query, $type)
    {
        if ($type)
            return $query->where('INS_TIPO','LIKE',"%$type%");
    }
    public function scopeWithCourse($query)
    {
        return $query->with('course');
    }
    public function scopeCourseID($query,$id)
    {
        if ($id)
        {
            return $query->where('id','=',$id)->get();
        }
    }
    public function scopeInstitutionId($query,$institution_id)
    {
        if ($institution_id)
            return $query->where('id','=',$institution_id)->get('INS_NOMBRE');
    }
    public function scopeInsId($query,$institution_id)
    {
        if ($institution_id)
        {
            return $query->where('id','=',$institution_id)->get();
        }
    }


}


