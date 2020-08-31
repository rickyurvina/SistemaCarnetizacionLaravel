<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Background extends Model
{
    protected $fillable = ['FON_NOMBRE', 'FON_NOMBRE2', 'FON_TIPO', 'institution_id'];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function scopeInstitution($query, $name)
    {
        if ($name) {
            return $query->where('institution_id', $name);
        }
    }
    public function scopeStore($query, $name)
    {
        if ($name) {
            return $query->where('institution_id', '=', $name);
        }
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('institution_id', 'DESC');
    }
    public function scopeWithInstitution($query)
    {
        return $query->with('institution');
    }
    public function scopeWithInstitutionBack($query, $institution_id)
    {
        if ($institution_id)
            return $query->with('institution')
                ->where('institution_id', '=', $institution_id)->get();
    }
}
