<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = [
        'exercise_id', 'user_id','created_by'
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
