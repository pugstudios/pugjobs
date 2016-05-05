<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Helper\HelperController as pr;

class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'newsletter', 'company_name', 
        'company_description', 'company_logo'
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
        // Company Logo Upload
        if (request::file('company_logo') !== null) {
            $ext = request::file('company_logo') -> extension();
            $logo = str_replace(" ", "_", $data['company_name']) . "_" . time() . ".". $ext;
            $imgUp = request::file('company_logo') -> move('../public/imgs/logos/', $logo);
        } else {
            $logo = NULL;
        }

        $user = new User();
        $user -> email = $data['email'];
        $user -> password = Hash::make($data['password']);
        $user -> newsletter = isset($user -> newsletter) ? $data['newsletter'] : 1;
        $user -> type = $data['type'];
        $user -> company_name = $data['company_name'];
        $user -> company_description = $data['company_description'];
        $user -> company_logo = $logo;
        $user -> save();

        return $user;
    }

}
