<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $dates=['EST_FECHANACIMIENTO'];
    protected $fillable=[
            'EST_CEDULA','EST_NOMBRES',
            'EST_APELLIDOS',
            'EST_SEXO',
            'EST_FECHANACIMIENTO',
            'EST_TIPOSANGRE',
            'EST_CORREO',
            'EST_DIRECCION',
            'EST_NUMERO',
            'EST_CELULAR',
            'EST_CODIGO',
            'EST_MATRICULA',
            'EST_INSCRITO',
            'EST_NROMATRICULA',
            'EST_RETIRADO',
            'EST_BECA',
            'course_id',
            'institution_id'];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function  course()
    {
        return $this->belongsTo(Course::class);
    }
    public function picture(){
        return $this->hasMany(Picture::class);
    }
    public function scopeOrderCreated($query)
    {
        return $query->orderBy('created_at','DESC');
    }
    public function scopeId($query,$students_id)
    {
        if ($students_id)
            return $query->where('EST_CEDULA','LIKE',"%$students_id%");
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('EST_NOMBRES','ASC');
    }
    public function scopeInstitutionId($query,$institution_id)
    {
        if ($institution_id)
            return $query->where('EST_CEDULA','LIKE',"%$institution_id%");
    }



}