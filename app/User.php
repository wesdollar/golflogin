<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'trial_ends_at'
    ];

    public function groups() {

        return $this->belongsToMany('App\Group');
    }

    public function hasGroup($group) {

        return $this->groups->contains($group);
    }

    public function activeGroup() {

        return $this->groups()->where('group_id', '=', $this->active_group);
    }
}
