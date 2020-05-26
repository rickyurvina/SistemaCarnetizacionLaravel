<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Solicitadas extends Model
{
    //
    protected $fillable=['cedula','tipo','institution_id'];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
