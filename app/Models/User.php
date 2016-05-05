<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Helper\HelperController as pr;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Creates a new user
     * 
     * @param array $data
     * @return \App\Models\User
     */
    public static function CreateUser($data) {
        $user = new User();
        $user -> email = $data['email'];
        $user -> password = Hash::make($data['password']);
        $user -> newsletter = isset($user -> newsletter) ? $data['newsletter'] : 1;
        $user -> save();
        
        return $user;
    }
}
