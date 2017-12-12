<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;
use Spatie\Permission\Traits\HasRoles;

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

    public function parent()
    {
        return $this->belongsTo('App\User', 'parent_id');
    }
}
