<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['name','display_name','description'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('id','asc');
    }

}
