<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable=['INS_NOMBRE','INS_DIRECCION','INS_TELEFONO','INS_CELULAR','INS_TIPO','INS_MISION','INS_VISION'];

    public function course(){
        return $this->hasMany(Course::class);
    }
    public function background(){
        return $this->hasOne(Background::class);
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
}


