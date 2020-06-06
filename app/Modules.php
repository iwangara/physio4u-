<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $fillable = ['name','created_by'];

    public function modules()
    {
//        return $this->hasMany(User::class);
    }
}
