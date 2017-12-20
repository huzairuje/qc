<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserManagement extends Model
{
    public function Users()
    {
    	$users = User::()
    }
}
