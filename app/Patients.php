<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{

    protected $fillable = ['age','gender','weight','height','address','user_id','created_by'];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
