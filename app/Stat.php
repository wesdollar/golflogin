<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];
    public $timestamps = true;

    public function user() {

        return $this->belongsTo('App\User');
    }

    public function group() {

        return $this->belongsTo('App\Group');
    }
}
