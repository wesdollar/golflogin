<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['group_id', 'title', 'tee_box', 'rating', 'slope'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function holes() {
        return $this->hasMany('App\Hole');
    }
}
