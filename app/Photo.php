<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable=['nombre','tipo','people_id'];

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

}
