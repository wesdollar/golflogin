<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{

    protected $fillable = ['user_id', 'course_id', 'group_id', 'date_played', 'type', 'starting_side', 'stats', 'tournament'];

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
