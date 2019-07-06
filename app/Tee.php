<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tee extends Model
{
    protected $fillable = ['title', 'rating', 'slope', 'course_id'];

    public function course() {

        return $this->belongsTo('App\Course');
    }
}
