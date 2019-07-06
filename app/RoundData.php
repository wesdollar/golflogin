<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoundData extends Model
{
    public function round() {

        return $this->belongsTo('App\Round');
    }

    public function hole() {

        return $this->belongsTo('App\Hole');
    }
}
