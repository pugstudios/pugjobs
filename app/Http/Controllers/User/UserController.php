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
            'company_name' => 'sometimes|required',
        ]);

        // Create user
        $userData = array(
            'email' => $request -> get('email'),
            'password' => $request -> get('password'),
            'newsletter' => $request -> get('newsletter'),
            'type' => $request -> get('type'),
            'company_name' => $request -> get('company_name') !== null ? $request -> get('company_name') : NULL,
            'company_description' => $request -> get('company_description') !== null ? $request -> get('company_description') : NULL,
            'company_logo' => $request -> file('company_logo') !== null ? $request -> file('company_logo') : NULL,
        );
        User::CreateUser($userData);

        // Login the user
        self::loginUser($request -> get('email'), $request -> get('password'));

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
        if (self::loginUser($request -> get('email'), $request -> get('password'))) {
            // Redirect to homepage
            return redirect('\\') -> with('success', 'Welcome back, ' . session('user') -> email);
        } else {
            return redirect('user\login') -> with('invalid-credentials', 'Email and/or password is invalid.');
        }
    }

    /**
     * Authenticates a user
     * 
     * @param object $user
     * @return boolean
     */
    private function loginUser($email, $password) {
        // Variables
        $authenticated = FALSE;

        // Authenticate
        if ($user = User::where('email', $email) -> first()) {
            if (Hash::check($password, $user -> password)) {
                $authenticated = TRUE;

                // Store user in the session
                session(['user' => $user]);
            }
        }

        return $authenticated;
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
