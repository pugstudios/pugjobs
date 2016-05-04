<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController as pr;

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
    public function login() {
        return view('pages.login', self::$data);
    }
    
    /**
     * Login Post
     * 
     * @return view
     */
    public function loginPost() {
        pr::show('here'); die();
    }

}
