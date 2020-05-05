<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    //
    protected $fillable=['LOG_NOMBRE','LOG_TIPO','institution_id'];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
