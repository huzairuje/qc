<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'first_name','last_name', 'email', 'password', 'username', 'phone'
    ];

    protected $loginNames = ['email', 'username', 'phone'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function childs()
    {
        return $this->hasMany('App\Models\User', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\User', 'parent_id');
    }

    public function userEvent()
    {
        return $this->hasMany('App\Models\UserEvent','user_id');
    }

    public function saksitps()
    {
        return $this->hasOne('App\Models\SaksiTps', 'user_id');
    }
}
