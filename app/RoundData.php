<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoundData extends Model
{
    // TODO: rename table to round_data
    protected $table = "rounds_data";

    protected $fillable = ['round_id', 'hole_id', 'strokes', 'putts', 'gir', 'fir', 'up_and_down', 'sand_save', 'penalty_strokes'];

    public function round() {

        return $this->belongsTo('App\Round');
    }

    public function hole() {

        return $this->belongsTo('App\Hole');
    }
}
