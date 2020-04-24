<?php

namespace App;

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

}
