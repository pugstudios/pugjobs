<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
     * Create A Company Account
     * 
     * @return view
     */
    public function createCompany() {
        return view('pages.create-company', self::$data);
    }

    /**
     * Create An Account Post
     * 
     * @return view
     */
    public function createPost(Request $request) {
        // Validation
        $this -> validate($request, [
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'newsletter' => 'required|boolean',
            'type' => 'required|in:employee,employer,staff',
            'name' => 'sometimes|required',
        ]);

        // Create user
        $userData = array(
            'email' => $request -> get('email'),
            'password' => $request -> get('password'),
            'newsletter' => $request -> get('newsletter'),
            'type' => $request -> get('type'),
            'name' => $request -> get('name') !== null ? $request -> get('name') : NULL,
            'description' => $request -> get('description') !== null ? $request -> get('description') : NULL,
            'logo' => $request -> file('logo') !== null ? $request -> file('logo') : NULL,
        );
        User::CreateUser($userData);

        // Login the user
        User::LoginUser($request -> get('email'), $request -> get('password'));

        // Redirect to homepage
        return redirect('\\') -> with('success', 'You have successfully created your account.');
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
     * @param Request $request
     * @return type
     */
    public function loginPost(Request $request) {
        // Validation
        $this -> validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Login User
        if (User::LoginUser($request -> get('email'), $request -> get('password'))) {
            // Redirect to homepage
            return redirect('\\') -> with('success', 'Welcome back, ' . session('user') -> email);
        } else {
            return redirect('user\login') -> with('invalid-credentials', 'Email and/or password is invalid.');
        }
    }

    /**
     * Logout
     * 
     * @return view
     */
    public function logout(Request $request) {
        // Destroy the user in the session
        $request -> session() -> forget('user');

        // Redirect to homepage
        return redirect('\\') -> with('success', 'You have successfully logged out.');
    }

}
