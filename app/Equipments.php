<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;


class Equipments extends Model
{
    use Taggable;
    protected $fillable = ['name','created_by','tags'];
}
