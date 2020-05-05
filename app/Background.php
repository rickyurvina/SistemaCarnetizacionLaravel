<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    //
    protected $fillable=['FON_NOMBRE','FON_TIPO','institution_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }


}
