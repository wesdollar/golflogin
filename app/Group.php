<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['owner_id', 'title', 'group_codew'];

    public function users() {

        return $this->belongsToMany('App\User');
    }

    public function courses() {

        return $this->hasMany('App\Course');
    }

    public function hasUser($user) {

        return $this->users->contains($user);
    }

}
