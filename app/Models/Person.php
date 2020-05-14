<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $dates=['PER_FECHANACIMIENTO'];
    protected $fillable=[
        'PER_CEDULA','PER_NOMBRES','PER_APELLIDOS',
        'PER_SEXO','PER_FECHANACIMIENTO','PER_TIPOSANGRE',
        'PER_CORREO','PER_DIRECCION','PER_NUMERO','PER_CELULAR','institution_id','area_id'
        ];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function photo(){
        return $this->hasOne(Photo::class);
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('created_at','DESC');
    }
    public function scopeInstitutionId($query,$institution_id)
    {
        if ($institution_id)
            return $query->where('institution_id',$institution_id);
    }
    public function scopeId($query,$id)
    {
        if ($id)
            return $query->where('PER_CEDULA','LIKE',"%$id%");
    }
    public function scopeOrderName($query)
    {
        return $query->orderBy('PER_NOMBRES','ASC');
    }
    public function scopePeopleId($query,$people_id)
    {
        if ($people_id)
            return $query->where('id','=',$people_id)
                ->get('PER_CEDULA');
    }
    public function scopePersonId($query,$people_id)
    {
        if ($people_id)
            return $query->where('id','=',$people_id)->get();
    }


}
