<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable=[
        'PER_CEDULA','PER_NOMBRES','PER_APELLIDOS',
        'PER_SEXO','PERFECHANACIMIENTO','PER_TIPOSANGRE',
        'PER_CORREO','PER_DIRECCION','PER_NUMERO','PER_CELULAR','institution_id',
        ];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
