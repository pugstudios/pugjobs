<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController as pr;
use App\Models\User;

class UserController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Create An Account
     * 
     * @return view
     */
    public function create() {
        return view('pages.create-account', self::$data);
    }

    /**
     * Login
     * 
     * @return view
     */
    public function login(Request $request) {
        return view('pages.login', self::$data);
    }

    /**
     * Login Post
     * 
     * @return view
     */
    public function loginPost(Request $request) {
        // Validation
        $this -> validate($request, [
            'login-email' => 'required',
            'login-password' => 'required',
        ]);

        // Variables
        $authenticated = FALSE;

        // Get the user
        $user = User::where('email', $request -> get('login-email')) -> first();

        // Authenticate
        if ($user) {
            pr::show($user);
            die();
        }

        // Return
        if ($authenticated) {
            
        } else {
            return redirect('user\login') -> with('invalid-credentials', 'Email and/or password is invalid.');
        }
    }

}
