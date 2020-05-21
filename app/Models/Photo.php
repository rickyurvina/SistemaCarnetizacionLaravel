<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable=['nombre','tipo','people_id'];

    public function people()
    {
        return $this->belongsTo(Person::class);
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('people_id','DESC');
    }
    public function scopeId($query,$person_id)
    {
        if ($person_id)
            return $query->where('people_id',$person_id);
    }
    public function scopeWithPerson($query,$person_id)
    {
        if ($person_id)
            return $query->with('people')
                ->where('people_id','=',$person_id)->get();
    }
    public function scopeWithPer($query)
    {
    return $query->with('people');
    }


}
