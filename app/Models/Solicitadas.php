<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Solicitadas extends Model
{
    //
    protected $fillable = ['cedula', 'tipo', 'institution_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function aprobadas()
    {
        return $this->hasOne(Aprobadas::class);
    }

    public function scopeOrderCreate($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeWhereInsId($query, $institution_id)
    {
        if ($institution_id) {
            return $query->where('institution_id', $institution_id);
        }
    }

}
