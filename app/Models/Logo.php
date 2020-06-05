<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    //
    protected $fillable = ['LOG_NOMBRE', 'LOG_TIPO', 'institution_id'];


    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function scopeWithInstitution($query)
    {
        return $query->with('institution')->get();
    }

    public function scopeInstitutionId($query, $institution_id)
    {
        if ($institution_id)
            return $query->where('institution_id', $institution_id);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('institution_id', 'DESC');
    }

    public function scopeWithInstitutionLogo($query, $institution_id)
    {
        if ($institution_id)
            return $query->with('institution')
                ->where('institution_id', '=', $institution_id)->get();
    }
}
