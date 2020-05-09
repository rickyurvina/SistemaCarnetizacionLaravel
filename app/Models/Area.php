<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable=['ARE_NOMBRE','ARE_DESCRIPCCION'];

    public function scopeName($query, $name)
    {
        if ($name)
        {
            return $query->where('ARE_NOMBRE','LIKE',"%$name%");
        }
    }
    public  function scopeNombre($query)
    {
        return $query->pluck('ARE_NOMBRE','id');
    }
}
