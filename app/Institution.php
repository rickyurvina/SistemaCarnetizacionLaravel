<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{

    public function course(){
        return $this->hasMany(Course::class);
    }

        protected $fillable=['INS_NOMBRE','INS_DIRECCION','INS_TELEFONO','INS_CELULAR','INS_TIPO'];
   // protected $guarded=[];
}


