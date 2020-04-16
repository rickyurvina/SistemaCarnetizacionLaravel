<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    //
//    protected $timestamps = true;
protected $fillable=['INS_NOMBRE','INS_DIRECCION','INS_TELEFONO','INS_CELULAR','INS_TIPO'];
   // protected $guarded=[];

    //scope
//    public function scopeINS_NOMBRE($query, $INS_NOMBRE)
//    {
//        if($INS_NOMBRE)
//            return $query->where('INS_NOMBRE','LIKE',"%$INS_NOMBRE%");
//    }
}


