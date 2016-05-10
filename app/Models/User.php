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
        'name', 'email', 'password', 'type', 'newsletter', 'name',
        'description', 'logo'
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
        if (request::file('logo') !== null) {
            $ext = request::file('logo') -> extension();
            $logo = str_replace(" ", "_", $data['name']) . "_" . time() . "." . $ext;
            $imgUp = request::file('logo') -> move('../public/imgs/logos/', $logo);
        } else {
            $logo = NULL;
        }

        $user = new User();
        $user -> email = $data['email'];
        $user -> password = Hash::make($data['password']);
        $user -> newsletter = isset($user -> newsletter) ? $data['newsletter'] : 1;
        $user -> type = $data['type'];
        $user -> name = $data['name'];
        $user -> description = $data['description'];
        $user -> logo = $logo;
        $user -> save();

        return $user;
    }

    public static function UpdateUser($user_id, $data) {
        try {
            if ($user = User::where('id', $user_id) -> first()) {
                foreach ($data as $k => $v) {
                    $user -> $k = $v;
                }
                $user -> save();
            } else {
                return back() -> with('error', 'User was not found in the system. (User::UpdateUser)');
            }
        } catch (Exception $e) {
            return json_encode(array(
                'error' => $e -> getMessage()
            ));
        }
    }

}
