<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aprobadas extends Model
{
    //
    protected $fillable=['solicitadas_id','institution_id'];
    public function solicitadas()
    {
        return $this->belongsTo(Solicitadas::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function scopeOrderWhere($query,$institution_id)
    {
        if ($institution_id)
        {
            return $query->orderBy('created_at','asc')->where('institution_id',$institution_id);
        }
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('created_at','asc');
    }
}
