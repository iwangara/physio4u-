<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use Taggable;
    protected $fillable = ['name','created_by'];

    public function modules()
    {
//        return $this->hasMany(User::class);
    }
}
