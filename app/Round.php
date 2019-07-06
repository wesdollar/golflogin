<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public function user() {

        return $this->belongsTo('App\User');
    }

    public function course() {

        return $this->belongsTo('App\Course');
    }

    public function group() {

        return $this->belongsTo('App\Group');
    }
}
