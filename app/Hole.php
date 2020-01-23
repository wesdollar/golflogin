<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hole extends Model
{

    protected $fillable = ['course_id', 'number', 'yardage', 'par'];

    public function tees() {
        return $this->belongsTo('App\Tee');
    }

    public function roundData() {
        return $this->hasMany('App\RoundData');
    }
}
